<?php

namespace Database\Seeders;

use App\Models\Comic;
use App\Models\Episode;
use Illuminate\Database\Seeder;

class ComicSeeder extends Seeder
{
    public function run(): void
    {
        $comics = [
            [
                'title'       => 'Shadow Blade',
                'author'      => 'Ryu Tanaka',
                'genre'       => 'Aksi',
                'status'      => 'published',
                'description' => 'Seorang pejuang bayangan memiliki dua pedang bermakna: satu untuk memotong musuh, satu lagi untuk melindungi orang yang dicintainya. Petualangan gelap penuh pertempuran epik berlatar dunia fantasi.',
                'cover'       => 'comic_cover_1.jpg',
            ],
            [
                'title'       => 'Celestia',
                'author'      => 'Hana Mizuki',
                'genre'       => 'Fantasi',
                'status'      => 'published',
                'description' => 'Seorang penyihir muda menemukan sayap cahaya yang membuatnya mampu terbang ke berbagai dunia paralel. Namun setiap dunia menyimpan rahasia kelam yang mengancam keseluruhannya.',
                'cover'       => 'comic_cover_2.jpg',
            ],
            [
                'title'       => 'Iron Titan',
                'author'      => 'Kenji Mori',
                'genre'       => 'Sci-Fi',
                'status'      => 'published',
                'description' => 'Di era kehancuran bumi, pilot muda mengendalikan mecha raksasa terakhir untuk melindungi sisa-sisa peradaban manusia dari invasi robot alien yang tak terkalahkan.',
                'cover'       => 'comic_cover_3.jpg',
            ],
            [
                'title'       => 'Blood Oath',
                'author'      => 'Sora Kurosaki',
                'genre'       => 'Horor',
                'status'      => 'published',
                'description' => 'Seorang pemuda yang terkutuk menjadi vampir harus memilih antara keabadian berlumuran darah atau kembali menjadi manusia dengan mengorbankan segalanya.',
                'cover'       => 'comic_cover_4.jpg',
            ],
            [
                'title'       => 'Neon Pulse',
                'author'      => 'Yuki Aihara',
                'genre'       => 'Cyberpunk',
                'status'      => 'published',
                'description' => 'Hacker perempuan terbaik di kota Neo Tokyo harus menginfiltrasi sistem AI terbesar yang mengontrol seluruh jaringan kehidupan kota, sebelum AI itu menghancurkan semua jiwa manusia.',
                'cover'       => 'comic_cover_5.jpg',
            ],
            [
                'title'       => 'Dragon Realm',
                'author'      => 'Takeru Fujiwara',
                'genre'       => 'Petualangan',
                'status'      => 'Ongoing',
                'description' => 'Bocah yatim piatu menemukan telur naga kuno dan menjadi penunggang naga pertama dalam seribu tahun. Bersama naganya, ia menjelajahi dunia untuk mengungkap asal-usul dirinya.',
                'cover'       => 'comic_cover_6.jpg',
            ],
            [
                'title'       => 'Silent Ghost',
                'author'      => 'Akane Shibuya',
                'genre'       => 'Horor',
                'status'      => 'Tamat',
                'description' => 'Sebuah sekolah tua menyimpan arwah gadis yang meninggal karena dibully. Kini arwah itu bangkit satu per satu untuk membalas dendam pada mereka yang dulu menyakitinya.',
                'cover'       => 'comic_cover_7.jpg',
            ],
            [
                'title'       => 'Crown of Thorns',
                'author'      => 'Mashiro Ito',
                'genre'       => 'Drama',
                'status'      => 'Ongoing',
                'description' => 'Ratu muda naik tahta setelah kerajaan porak-poranda akibat perang saudara. Dengan mahkota berduri di kepalanya, ia harus memilih antara cinta, keadilan, atau kekuasaan.',
                'cover'       => 'comic_cover_8.jpg',
            ],
            [
                'title'       => 'Galactic Drift',
                'author'      => 'Cosmo Yamamoto',
                'genre'       => 'Romance',
                'status'      => 'Ongoing',
                'description' => 'Dua pilot pesawat antariksa dari negara musuh jatuh cinta di tengah perang galaksi. Mereka harus memilih antara kesetiaan pada negara atau hati mereka yang telah bertautan.',
                'cover'       => 'comic_cover_9.jpg',
            ],
            [
                'title'       => 'Beast Within',
                'author'      => 'Ryota Shindo',
                'genre'       => 'Aksi',
                'status'      => 'Ongoing',
                'description' => 'Seorang pemuda tersimpan kekuatan serigala purba dalam dirinya. Setiap bulan purnama ia berubah menjadi monster. Kini ia harus belajar mengendalikan binatang dalam dirinya sebelum menghancurkan semua yang ia cintai.',
                'cover'       => 'comic_cover_10.jpg',
            ],
        ];

        foreach ($comics as $index => $data) {
            $comicNumber = $index + 1;

            $comic = Comic::create([
                'title'       => $data['title'],
                'author'      => $data['author'],
                'genre'       => $data['genre'],
                'status'      => $data['status'],
                'description' => $data['description'],
                'cover_image' => 'covers/' . $data['cover'],
            ]);

            // Create 3 episodes per comic
            for ($ep = 1; $ep <= 3; $ep++) {
                $episodeTitles = [
                    1 => 'Awal Perjalanan',
                    2 => 'Pertarungan Pertama',
                    3 => 'Rahasia Terungkap',
                ];

                Episode::create([
                    'comic_id'       => $comic->id,
                    'episode_number' => $ep,
                    'title'          => "Episode {$ep}: " . $episodeTitles[$ep],
                    'pdf_file'       => "episodes/episode_comic{$comicNumber}_ep{$ep}.pdf",
                ]);
            }
        }
    }
}
