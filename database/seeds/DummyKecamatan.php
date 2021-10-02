<?php

use Illuminate\Database\Seeder;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

class DummyKecamatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->kabupaten();
        $this->kecamatan();
        $this->desa();
    }

    public function kabupaten()
    {
        $payload = [
            'nama' => 'Kabupaten Tegal'
        ];

        Kabupaten::firstOrCreate($payload)->sharedLock()->get();

        $payload = [
            'nama' => 'Kota Tegal'
        ];

        Kabupaten::firstOrCreate($payload);
    }

    public function kecamatan()
    {
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Adiwerna'
        ];

        Kecamatan::firstOrCreate($payload)->sharedLock()->get();

        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Balapulang'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Bojong'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Bumijawa'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Dukuhturi'
        ];

        Kecamatan::firstOrCreate($payload);
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Dukuhwaru'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Jatinegara'
        ];

        Kecamatan::firstOrCreate($payload);
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Kedungbanteng'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Kramat'
        ];

        Kecamatan::firstOrCreate($payload);
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Lebaksiu'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Margasari'
        ];

        Kecamatan::firstOrCreate($payload);
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Pagerbarang'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Pangkah'
        ];

        Kecamatan::firstOrCreate($payload);
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Slawi'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Suradadi'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Talang'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Tarub'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '1',
            'nama' => 'Warureja'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '2',
            'nama' => 'Margadana'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '2',
            'nama' => 'Tegal Barat'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '2',
            'nama' => 'Tegal Selatan'
        ];

        Kecamatan::firstOrCreate($payload);
        
        $payload = [
            'kabupaten_id' => '2',
            'nama' => 'Tegal Timur'
        ];

        Kecamatan::firstOrCreate($payload);

    }

    public function desa()
    {
        //Adiwerna
        $payload = ['kecamatan_id' => '1','nama' => 'Adiwerna'];Desa::firstOrCreate($payload)->sharedLock()->get();
        $payload = ['kecamatan_id' => '1','nama' => 'Bersole'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Gumalar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Harjosari Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Harjosari Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Kalimati'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Kaliwadas'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Kedungsukun'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Lemahduwur'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Lumingser'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Pagedangan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Pagiyanten'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Pecangakan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Pedeslohor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Penarukan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Pesarean'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Tembok Banjaran'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Tembok Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Tembok Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Tembok Luwung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '1','nama' => 'Ujungrusi'];Desa::firstOrCreate($payload);

        //Balapulang
        $payload = ['kecamatan_id' => '2','nama' => 'Balapulang Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Balapulang Wetan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Banjar Anyar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Batuagung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Bukateja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Cenggini'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Cibunar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Cilongok'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Danareja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Danawarih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Harjowinangun'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Kalibakung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Kaliwungu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Karangjambu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Pagerwangi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Pamiritan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Sangkanjaya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Sesepan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Tembongwah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '2','nama' => 'Wringin Jenggot'];Desa::firstOrCreate($payload);


        //Bojong
        $payload = ['kecamatan_id' => '3','nama' => 'Batunyana'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Bojong'];Desa::firstOrCreate($payload);       
        $payload = ['kecamatan_id' => '3','nama' => 'Buniwah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Cikura'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Danasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Dukuhtengah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Gunungjati'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Kajenengan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Kalijambu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Karangmulyo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Kedawung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Lengkong'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Pucang Luwuk'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Rembul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Sangkanayu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Suniarsih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '3','nama' => 'Tuwel'];Desa::firstOrCreate($payload);
        
        //Bumijawa                
        $payload = ['kecamatan_id' => '4','nama' => 'Batumirah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Begawat'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Bumijawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Carul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Cawitali'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Cempaka'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Cintamanik'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Dukuh Benda'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Guci'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Gunung Agung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Jejeg'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Muncanglarang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Pagerkasih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Sigedong'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Sokasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Sokatengah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Sumbaga'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '4','nama' => 'Traju'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '5','nama' => 'Bandasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Debong Wetan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Dukuhturi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Grogol'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Kademangaran'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Karanganyar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Kepandean'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Ketanggungan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Kupu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Lawatan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Pagongan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Pekauman Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Pengabean'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Pengarasan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Pepedan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Sidakaton'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Sidapurna'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '5','nama' => 'Sutapranan'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '6','nama' => 'Blubuk'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Bulakpacing'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Dukuhwaru'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Gumayun'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Kabunan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Kalisoka'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Pedagangan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Selapura'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Sindang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '6','nama' => 'Slarang Lor'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '7','nama' => 'Argatawang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Capar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Cerih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Dukuhbangsa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Gantungan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Jatinegara'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Kedungwungu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Lebakwangi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Lembasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Luwijawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Mokaha'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Padasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Penyalahan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Setail'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Sumbarang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Tamansari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '7','nama' => 'Wotgalih'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '8','nama' => 'Dukuhjati Wetan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Karang Anyar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Karangmalang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Kebandingan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Kedung Banteng'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Margamulya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Penujah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Semedo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Sumingkir'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '8','nama' => 'Tonggara'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '9','nama' => 'Babakan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Bangun Galih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Bongkok'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Dinuk'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Jatilawang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kemantran'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kemuning'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kepunduhan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kertaharja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kertayasa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Ketileng'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Kramat'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Maribaya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Mejasem Barat'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Mejasem Timur'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Munjung Agung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Padaharja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Plumbungan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Tanjung Harja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '9','nama' => 'Dampyak'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '10','nama' => 'Balaradin'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Dukuhdamu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Dukuhlo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Jatimulyo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Kajen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Kambangan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Kesuben'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Lebak Goah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Lebaksiu Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Lebaksiu Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Pendawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Slarang Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Tegalandong'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Timbangreja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '10','nama' => 'Yamansari'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '11','nama' => 'Danaraja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Dukuh Tengah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Jatilaba'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Jembayat'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Kaligayam'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Kalisalak'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Karangdawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Marga Ayu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Margasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Pakulaut'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Prupuk Selatan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Prupuk Utara'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '11','nama' => 'Wanasari'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '12','nama' => 'Jatiwangi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Karanganyar'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Kedungsugih'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Kertaraharja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Mulyoharjo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Pagerbarang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Pesarean'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Rajegwesi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Randusari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Semboja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Sido Mulyo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Srengseng'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '12','nama' => 'Surokidul'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '13','nama' => 'Balamoa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Bedug'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Bogares Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Bogares Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Curug'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Depok'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Dermasandi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Dermasuci'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Dukuhjati Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Dukuhsembung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Grobog Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Grobog Wetan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Jenggawur'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Kalikangkung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Kendalserut'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Paketiban'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Pangkah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Pecabean'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Pener'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Penusupan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Purbayasa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Rancawiru'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '13','nama' => 'Talok'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '14','nama' => 'Dukuhsalam'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Dukuhwringin'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Kalisapu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Slawi Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Trayeman'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Kagok'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Kudaile'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Pakembaran'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Procot'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '14','nama' => 'Slawi Wetan'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '15','nama' => 'ojongsana'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'embongdadi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'arjasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'atibogor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'atimulya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'arangmulya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'arangwuluh'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'ertasari'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'urwahamba'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'idoharjo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '15','nama' => 'uradadi'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '16','nama' => 'Bengle'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Cangkring'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Dawuhan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Dukuhmalang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Gembong Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Getaskerep'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Kajen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Kaladawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Kaligayam'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Kebasen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Langgen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Pacul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Pasangan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Pegirikan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Pekiringan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Pesayangan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Talang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Tegalwangi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '16','nama' => 'Wangandawa'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '17','nama' => 'Brekat'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Bulakwaru'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Bumiharja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Jatirawa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kabukan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kalijambe'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Karangjati'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Karangmangu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kedokan Sayang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kedung Bungkus'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kemanggungan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kesadikan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Kesamiran'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Lebeteng'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Mangunsaren'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Margapadang'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Mindaka'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Purbasana'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Setu'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '17','nama' => 'Tarub'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '18','nama' => 'Banjar Agung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Banjarturi'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Demangharjo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Kedungjati'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Kedungkelor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Kendayakan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Kreman'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Rangimulya'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Sidomulyo'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Sigentong'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Sukareja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '18','nama' => 'Warureja'];Desa::firstOrCreate($payload);
        
        $payload = ['kecamatan_id' => '19','nama' => 'Cabawan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Kaligangsa'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Kalinyamat Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Krandon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Margadana'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Pesurungan Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '19','nama' => 'Sumurpanggang'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '20','nama' => 'Debong Lor'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Kemandungan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Kraton'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Muarareja'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Pekauman'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Pesurungan Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '20','nama' => 'Tegalsari'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '21','nama' => 'Bandung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Debong Kidul'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Debong Kulon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Debong Tengah'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Kalinyamat Wetan'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Keturen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Randugunting'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '21','nama' => 'Tunon'];Desa::firstOrCreate($payload);

        $payload = ['kecamatan_id' => '22','nama' => 'Kejambon'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '22','nama' => 'Mangkukusuman'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '22','nama' => 'Mintaragen'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '22','nama' => 'Panggung'];Desa::firstOrCreate($payload);
        $payload = ['kecamatan_id' => '22','nama' => 'Slerok'];Desa::firstOrCreate($payload);

    }
}
