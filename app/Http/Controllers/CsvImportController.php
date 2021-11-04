<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileObject;
use App\Models\Word;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {

        // Word::truncate();

        setlocale(LC_ALL, 'ja_JP.UTF-8');

        $uploaded_file = $request->file('csv_file');

        $file_path = $request->file('csv_file')->path($uploaded_file);

        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);

        //配列の箱を用意
        $array = [];

        $row_count = 1;
        
        foreach ($file as $row)
        {

            if ($row === [null]) continue; 
            
            if ($row_count > 1)
            {
            
                // $en = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
                // $jp = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
                // $level = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
                // $frequency = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');
                // $reputation = mb_convert_encoding($row[4], 'UTF-8', 'SJIS');
            
                $csvimport_array = [
                    'en' => $row[0], 
                    'jp' => $row[1], 
                    'level' => $row[2], 
                    'frequency' => $row[3],
                    'reputation' => $row[4]
                ];

                // つくった配列の箱($array)に追加
                array_push($array, $csvimport_array);
            }

            $row_count++;

        }
        
        //追加した配列の数を数える
        $array_count = count($array);

        //もし配列の数が500未満なら
        if ($array_count < 500){

            //配列をまるっとインポート(バルクインサート)
            Word::insert($array);


        } else {
            
            //追加した配列が500以上なら、array_chunkで500ずつ分割する
            $array_partial = array_chunk($array, 500); //配列分割
    
            //分割した数を数えて
            $array_partial_count = count($array_partial); //配列の数

            //分割した数の分だけインポートを繰り替えす
            for ($i = 0; $i <= $array_partial_count - 1; $i++){
                Word::insert($array_partial[$i]);
            }

        }

        return redirect('import')->with('flash_message', '完了しました');
    }
}
