<?php

namespace Database\Seeders;
use DB;
use Hash;
use Carbon\Carbon;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $prefix = 'PETERNAK';
        $year = Carbon::now()->format('Y');
        $padLength = 4;
        $files = [
            database_path('seeders/data/DATA KERISPUSAKA - Banjar.csv'),
            database_path('seeders/data/DATA KERISPUSAKA - Langensari.csv'),
            database_path('seeders/data/DATA KERISPUSAKA - Pataruman.csv'),
            database_path('seeders/data/DATA KERISPUSAKA - Purwaharja.csv'),
        ];

        foreach ($files as $file) {
            if (!file_exists($file)) continue;

            $header = null;

            if (($handle = fopen($file, 'r')) !== false) {
                while (($row = fgetcsv($handle, 2000, ',')) !== false) 
                    {

                    // Set header
                    if (!$header) {
                        $header = $row;
                        continue;
                    }

                    $record = array_combine($header, $row);
                    $id = null;
                    $count = DB::table('peternak')->count();
                            if($count == 0){
                                $id= "{$prefix}-{$year}-0001";
                            }else{
                                $lastRow = DB::table('peternak')->orderBy('id_peternak', 'desc')->first();
                                $lastId = $lastRow->id_peternak;
                                $lastNumber = (int) substr($lastId, strrpos($lastId, '-') + 1);
                                $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                                $id = "{$prefix}-{$year}-{$nextNumber}";
                            };
                    // ---- INSERT PETERNak ----
                    $peternakId = DB::table('peternak')->insertGetId([
                        
                        'id_peternak'  => $id,
                        'nama'         => $record['NAMA PETERNAK'] ?? $record['Nama Peternak'] ?? null,
                        'no_hp'      => preg_replace('/[^0-9]/', '', ($record['NO TELEPON'] ?? $record['No Telepon'] ?? '')),
                        'alamat'         => $record['DESA'] ?? $record['Desa'] ?? null,
                        'jenis_ternak' => $record['JENIS TERNAK'] ?? $record['Jenis Ternak'] ?? null,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);

                    // ---- INSERT USER ----
                    DB::table('users')->insert([
                        'id_user' => $id,
                        'username'    => $record['username'] ?? null,
                        'password'    => Hash::make($record['password'] ?? '123456'),
                        'role'        => 'peternak',
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }

                fclose($handle);
            }
        }
        DB::table('users')->insert(['username'=>'admin','role'=>'super admin','password'=>Hash::make('password'),'id_user'=>'admin']);
    }
}


 
