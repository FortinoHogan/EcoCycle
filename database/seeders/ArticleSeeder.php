<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $article = [
            [
                'image' => 'article1.jpg',
                'title' => 'Mengubah Sampah Menjadi Emas: Panduan Praktis Daur Ulang untuk Pemula',
                'createdDate' => '2024-01-01',
                'description' => 'Sampah telah menjadi masalah besar bagi lingkungan kita. Namun, apa yang banyak orang tidak tahu adalah bahwa sampah bisa diubah menjadi sumber daya yang berharga melalui proses daur ulang. Daur ulang adalah cara untuk mengubah limbah menjadi bahan atau produk baru yang dapat digunakan kembali, mengurangi kebutuhan akan bahan baku baru, serta mengurangi polusi. Di rumah, Anda bisa mulai dengan memisahkan sampah ke dalam kategori berbeda, seperti sampah organik, plastik, kertas, dan logam. Dengan mengenali jenis sampah yang bisa didaur ulang, seperti botol plastik, kaleng aluminium, kaca, dan kardus, kita bisa mengurangi jumlah sampah yang akhirnya berakhir di tempat pembuangan akhir. Selain itu, daur ulang juga memiliki manfaat besar bagi lingkungan. Mengurangi polusi dan emisi karbon, menghemat energi, serta memberi peluang untuk menghasilkan produk baru yang ramah lingkungan, seperti kerajinan tangan dari bahan daur ulang. Dengan langkah kecil yang dilakukan setiap hari, kita dapat membantu melestarikan bumi untuk generasi mendatang.',
            ],
            [
                'image' => 'article2.jpg',
                'title' => 'Ide Daur Ulang untuk Dekorasi Rumah',
                'createdDate' => '2024-02-02',
                'description' => 'Barang bekas sering kali dianggap sebagai sampah yang tidak berguna, padahal banyak sekali barang bekas yang bisa diubah menjadi dekorasi rumah yang unik dan menarik. Dengan sedikit kreativitas, barang-barang yang sudah tidak terpakai ini bisa memberikan sentuhan baru pada ruangan rumah Anda. Misalnya, Anda dapat mengubah botol plastik bekas menjadi vas bunga yang cantik dengan sedikit cat atau kain. Selain itu, CD bekas yang tidak terpakai bisa dimanfaatkan menjadi lampu gantung yang memantulkan cahaya warna-warni, menciptakan suasana yang hangat dan menarik. Kardus bekas juga dapat disulap menjadi rak buku kecil yang fungsional dan estetik. Bahkan, barang bekas seperti kertas bisa diolah menjadi piggy bank lucu yang bisa menjadi alat edukasi bagi anak-anak tentang pentingnya menabung dan daur ulang. Dengan mendaur ulang barang-barang bekas untuk dekorasi, Anda tidak hanya menghemat biaya, tetapi juga turut serta dalam upaya mengurangi limbah yang ada. Selain itu, rumah Anda akan memiliki sentuhan personal dan unik yang tidak bisa ditemukan di toko-toko.',
            ],
            [
                'image' => 'article3.jpg',
                'title' => 'Manfaat Ekonomi dan Lingkungan dari Daur Ulang Sampah',
                'createdDate' => '2024-03-03',
                'description' => 'Daur ulang tidak hanya memberikan manfaat bagi lingkungan, tetapi juga dapat memberikan dampak positif terhadap ekonomi. Salah satu keuntungan dari daur ulang adalah terbukanya peluang bisnis baru. Industri daur ulang memungkinkan terbentuknya bisnis yang mengolah bahan bekas menjadi barang yang berguna, seperti kerajinan tangan, bahan baku untuk produk baru, dan barang-barang ramah lingkungan. Dengan semakin banyaknya konsumen yang sadar akan pentingnya berbelanja produk ramah lingkungan, pasar untuk barang-barang daur ulang terus berkembang. Selain itu, menggunakan bahan daur ulang dalam produksi barang-barang baru juga dapat mengurangi biaya produksi, karena bahan daur ulang lebih murah dibandingkan bahan baku mentah. Di sisi lain, daur ulang juga menciptakan lapangan kerja baru dalam berbagai sektor, mulai dari pengumpulan sampah, pemilahan, hingga pengolahan menjadi produk baru. Secara lingkungan, daur ulang membantu mengurangi polusi, menghemat sumber daya alam, serta mengurangi jumlah limbah yang dibuang ke tempat pembuangan akhir. Dengan demikian, daur ulang tidak hanya bermanfaat untuk alam, tetapi juga berkontribusi terhadap pertumbuhan ekonomi yang berkelanjutan.',
            ],
            [
                'image' => 'article4.jpg',
                'title' => 'Daur Ulang Plastik: Tantangan dan Solusinya',
                'createdDate' => '2024-04-04',
                'description' => 'Plastik telah menjadi bagian tak terpisahkan dari kehidupan sehari-hari kita. Namun, plastik juga menjadi salah satu jenis sampah yang paling sulit diolah dan menjadi tantangan besar bagi lingkungan. Salah satu masalah utama dalam daur ulang plastik adalah tidak semua jenis plastik dapat didaur ulang. Beberapa plastik, terutama yang sulit diproses, membutuhkan teknologi yang lebih canggih dan biaya yang tinggi untuk daur ulang. Selain itu, kurangnya kesadaran masyarakat dalam memilah sampah plastik juga memperburuk situasi ini. Namun, ada beberapa solusi yang bisa membantu mengatasi tantangan ini. Salah satunya adalah dengan meningkatkan edukasi masyarakat mengenai pentingnya memilah sampah plastik sejak awal, sehingga plastik yang bisa didaur ulang bisa lebih mudah diproses. Selain itu, perkembangan teknologi juga memungkinkan pembuatan plastik ramah lingkungan, seperti bioplastik, yang lebih mudah diurai oleh alam. Dalam skala yang lebih besar, penggunaan produk yang ramah lingkungan, seperti bahan kertas atau bambu, juga dapat mengurangi ketergantungan kita pada plastik sekali pakai. Dengan kerja sama antara masyarakat, pemerintah, dan industri, kita dapat mengurangi dampak negatif plastik dan mulai beralih ke bahan yang lebih berkelanjutan.',
            ]
        ];

        foreach($article as $a){
            Article::create(array_merge($a, [
                'image' => file_get_contents(public_path('asset/article/'.$a['image'])),
            ]));
        }
    }
}
