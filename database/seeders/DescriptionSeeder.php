<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Description;

class DescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $description = [
            [
                'product_id' => 1,
                'ingredient' => 'Kertas bekas dan lem berbasis air ramah lingkungan',
                'origin' => 'Kertas bekas dikumpulkan dari rumah tangga dan kantor yang berpartisipasi dalam program daur ulang. Kertas ini kemudian diproses dan dibentuk untuk menciptakan piggy bank yang lucu.',
                'description' => 'Produk ini membantu mengurangi limbah kertas yang berakhir di tempat pembuangan akhir. Dengan menggunakan teknik produksi manual, penggunaan energi dan emisi karbon diminimalkan. Piggy bank ini juga memberikan edukasi kepada masyarakat tentang pentingnya daur ulang dan pengelolaan limbah.'
            ],
            [
                'product_id' => 2,
                'ingredient' => 'Plastik bekas dan cat ramah lingkungan.',
                'origin' => 'Plastik bekas dikumpulkan dari bank sampah lokal atau rumah tangga, lalu diproses dengan teknik potong dan lipat kreatif untuk menciptakan desain unik seperti dalam gambar.',
                'description' => 'Vas ini memberikan solusi kreatif untuk mengurangi limbah plastik dengan mengubah botol bekas menjadi dekorasi yang berguna dan estetis. Pembuatan vas mengandalkan teknik manual, sehingga meminimalkan penggunaan energi. Selain itu, produk ini juga menginspirasi kesadaran akan pentingnya daur ulang dalam kehidupan sehari-hari.'
            ],
            [
                'product_id' => 3,
                'ingredient' => 'Plastik bekas dan besi daur ulang',
                'origin' => 'Plastik bekas dikumpulkan dari limbah rumah tangga, seperti botol dan kantong plastik, kemudian dilebur dan dicetak menjadi permukaan meja yang kokoh dan artistik. Besi berasal dari limbah konstruksi yang diproses ulang untuk memastikan kekuatannya.',
                'description' => 'Meja ini memanfaatkan limbah plastik dan besi yang sulit terurai secara alami, sehingga membantu mengurangi volume sampah di lingkungan. Proses pembuatannya juga meminimalkan energi dan emisi karbon, memberikan nilai tambah dari penggunaan material bekas.'
            ],
            [
                'product_id' => 4,
                'ingredient' => 'Kertas bekas dan lem berbasis air ramah lingkungan',
                'origin' => 'Kertas bekas dikumpulkan dari rumah tangga dan kantor yang berpartisipasi dalam program daur ulang. Kertas ini kemudian diproses dan dibentuk untuk menciptakan piggy bank yang lucu.',
                'description' => 'Produk ini membantu mengurangi limbah kertas yang berakhir di tempat pembuangan akhir. Dengan menggunakan teknik produksi manual, penggunaan energi dan emisi karbon diminimalkan. Piggy bank ini juga memberikan edukasi kepada masyarakat tentang pentingnya daur ulang dan pengelolaan limbah.'
            ],
            [
                'product_id' => 5,
                'ingredient' => 'Plastik bekas dan cat ramah lingkungan.',
                'origin' => 'Plastik bekas dikumpulkan dari bank sampah lokal atau rumah tangga, lalu diproses dengan teknik potong dan lipat kreatif untuk menciptakan desain unik seperti dalam gambar.',
                'description' => 'Vas ini memberikan solusi kreatif untuk mengurangi limbah plastik dengan mengubah botol bekas menjadi dekorasi yang berguna dan estetis. Pembuatan vas mengandalkan teknik manual, sehingga meminimalkan penggunaan energi. Selain itu, produk ini juga menginspirasi kesadaran akan pentingnya daur ulang dalam kehidupan sehari-hari.'
            ],
            [
                'product_id' => 6,
                'ingredient' => 'Plastik bekas dan besi daur ulang',
                'origin' => 'Plastik bekas dikumpulkan dari limbah rumah tangga, seperti botol dan kantong plastik, kemudian dilebur dan dicetak menjadi permukaan meja yang kokoh dan artistik. Besi berasal dari limbah konstruksi yang diproses ulang untuk memastikan kekuatannya.',
                'description' => 'Meja ini memanfaatkan limbah plastik dan besi yang sulit terurai secara alami, sehingga membantu mengurangi volume sampah di lingkungan. Proses pembuatannya juga meminimalkan energi dan emisi karbon, memberikan nilai tambah dari penggunaan material bekas.'
            ],
            [
                'product_id' => 7,
                'ingredient' => 'Kertas bekas dan lem berbasis air ramah lingkungan',
                'origin' => 'Kertas bekas dikumpulkan dari rumah tangga dan kantor yang berpartisipasi dalam program daur ulang. Kertas ini kemudian diproses dan dibentuk untuk menciptakan piggy bank yang lucu.',
                'description' => 'Produk ini membantu mengurangi limbah kertas yang berakhir di tempat pembuangan akhir. Dengan menggunakan teknik produksi manual, penggunaan energi dan emisi karbon diminimalkan. Piggy bank ini juga memberikan edukasi kepada masyarakat tentang pentingnya daur ulang dan pengelolaan limbah.'
            ],
            [
                'product_id' => 8,
                'ingredient' => 'Plastik bekas dan cat ramah lingkungan.',
                'origin' => 'Plastik bekas dikumpulkan dari bank sampah lokal atau rumah tangga, lalu diproses dengan teknik potong dan lipat kreatif untuk menciptakan desain unik seperti dalam gambar.',
                'description' => 'Vas ini memberikan solusi kreatif untuk mengurangi limbah plastik dengan mengubah botol bekas menjadi dekorasi yang berguna dan estetis. Pembuatan vas mengandalkan teknik manual, sehingga meminimalkan penggunaan energi. Selain itu, produk ini juga menginspirasi kesadaran akan pentingnya daur ulang dalam kehidupan sehari-hari.'
            ]
        ];

        foreach($description as $d){
            Description::create($d);
        }
    }
}
