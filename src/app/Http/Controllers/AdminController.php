<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->with(['category', 'user']);
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'like', "%{$name}%")
                  ->orWhere('first_name', 'like', "%{$name}%")
                  ->orWhere('email', 'like', "%{$name}%");
            });
        }
        if ($request->filled('gender') && $request->input('gender') !== '全て') {
            $genderMap = [
                '男性' => 1,
                '女性' => 2,
                'その他' => 3,
            ];
            $gender = $genderMap[$request->input('gender')] ?? null;
            if ($gender) {
                $query->where('gender', $gender);
            }
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
    
        $contacts = $query->paginate(7);
        $categories = Category::all();
// モーダル追加
        $selectedContact = null;
        if ($request->filled('detail_id')) {
            $selectedContact = Contact::with(['category', 'user'])->find($request->detail_id);
        }
        
        return view('admin.index', [
            'contacts' => $contacts,
            'categories' => $categories,
// モーダル追加
            'selectedContact' => $selectedContact,
        ]);
    }
// モーダル　destroy メソッドを追加 
        public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }


// エクスポート

    // <!-- ブラウザから送られた検索条件（例：名前、性別など）を受け取って、それに一致するお問い合わせデータをCSV形式で出力（ダウンロード） するメソッド-->
    public function export(Request $request)
    {
    
    // <!-- Contact モデルを使って検索クエリを開始-->
    // <!-- category（リレーション）も一緒に取得-->
        $query = Contact::query()->with('category');
    
    // <!-- 名前、メール、性別、カテゴリー、日付などが送信されていたら、それに応じて 絞り込み を行う処理-->
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->name . '%')
                  ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }
      
    if ($request->filled('gender') && $request->gender !== '全て') {
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        $gender = $genderMap[$request->gender] ?? null;
        if ($gender) {
            $query->where('gender', $gender);
        }
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    
    // <!-- 絞り込み済みのデータを全件取得-->
        $contacts = $query->get();
    
    // <!-- () に渡す配列を作成-->
    //  map() は foreach と同じで、データをCSV用の配列に変換-->
        $csvHeader = [    'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'
        ];
        $csvData = $contacts->map(function ($contact) {
            return [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '',
                $contact->detail,
            ];
        });
    
        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';
    
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);
    
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
    
    // <!-- ファイルの先頭に戻って中身を読み取り、閉じる—>
        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);
    
    // <!-- ブラウザに「このデータはCSVとしてダウンロードしてください」という指示-->
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }
}