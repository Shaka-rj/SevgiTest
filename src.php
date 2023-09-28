<?php
class Algoritm {
    /**
     * yoshi orasidagi farqqa asoslangan
     */
    private function yosh_farqi($yigit, $qiz){

    }
}

class SevgiTest extends Algoritm {
    public $xato = '';

    /**
     * @var string yigitning ismi
    */
    private $yigit_ism;

    /**
     * @var string qizning ismi
    */
    private $qiz_ism;

    /**
     * @var integer [1...100] yigit yoshi
    */
    private $yigit_yosh;

    /**
     * @var integer [1...100] qiz yoshi
     */
    private $qiz_yosh;

    /**
     * @var integer [1...100]yosh yigit to'gilgan yili
    */
    private $yigit_yil;

    /**
     * @var integer [1...100]yosh qiz to'gilgan yili
     */
    private $qiz_yil;

    /**
     * @var integer [1..12] yigit tug'ilgan oyi
     */
    private $yigit_oy;

    /**
     * @var integer [1..12] qiz tug'ilgan oyi
     */
    private $qiz_oy;

    /**
     * @var integer [1..28/30/31] yigit tug'ilgan kuni
     */
    private $yigit_kun;

    /**
     * @var integer [1..28/30/31] qiz tug'ilgan kuni
     */
    private $qiz_kun;


    /**
     * o'rnatuvchi
     * @param string $tur o'rnatilayotgan qiymat turi
     * @param string, array $qiymat o'rnatilayotgan qiymat 
    */ 
    public function setter($tur, $qiymat)
    {
        $javob = false;

        /**
         * ism: ismni o'rnatadi
         * * * yigit: yigitni ismi
         * * * qiz: qizni ismi
         * tugilgan_sana: tug'ilgan sana orqali o'rnatadi (yil, yosh, oy, kun)
         * * * yigit: kun.oy.yil yigitni to'g'ilgan sanasi 
         * * * qiz: kun.oy.yil qizni to'g'ilgan sanasi 
         * yosh: yoshni o'rnatadi
         * * * yigit: yigitni yoshi
         * * * qiz: qizni yoshi
         * 
        */
        if ($tur == 'ism')
        {
            $this->yigit_ism = $qiymat['yigit'];
            $this->qiz_ism = $qiymat['ism'];
            $javob = true;
        }
        elseif ($tur == 'tugilgan_sana')
        {
            $vaqt = time();
            $xozirgi_yil = date("Y", $vaqt);

            $yigit = explode('.', $qiymat['yigit']);
            $qiz = explode('.', $qiymat['qiz']);

            $yigit_yosh = $xozirgi_yil - $yigit[2];
            $qiz_yosh = $xozirgi_yil - $qiz[2];

            if ($this->setter('yosh', ['yigit' => $yigit_yosh, 'qiz' => $qiz_yosh]))
            {
                $this->setter('yil', ['yigit' => $yigit[2], 'qiz' => $qiz[2]]);
            }

            $this->setter('oy', ['yigit' => $yigit[1], 'qiz' => $qiz[1]]);
            $this->setter('kun', ['yigit' => $yigit[0], 'qiz' => $qiz[0]]);
        }
        elseif ($tur == 'yosh')
        {
            if ($this->tekshirish($tur, $qiymat))
            {
                $this->yigit_yosh = intval($qiymat['yigit']);
                $this->qiz_yosh = intval($qiymat['qiz']);
                $javob = true;
            }
            else
            {
                $this->xato .= 'Yosh 1 va 100 oralig`ida bo`lishi kerak';
            }
        }
        elseif ($tur == 'yil')
        {
            if ($this->tekshirish($tur))
            {
                $this->yigit_yil = intval($qiymat['yigit']);
                $this->qiz_yil = intval($qiymat['qiz']);
                $javob = true;
            }
            else
            {
                $this->xato .= 'Yosh 1 va 100 oralig`ida bo`lishi kerak';
            }
        }
        elseif ($tur == 'oy')
        {
            if ($this->tekshirish($tur, $qiymat))
            {
                $this->yigit_oy = intval($qiymat['yigit']);
                $this->qiz_oy = intval($qiymat['qiz']);
                $javob = true;
            }
            else
            {
                $this->xato .= 'Tug`ilgan oy 1 va 12 oralig`ida bo`lishi kerak';
            }
        }
        elseif ($tur == 'kun')
        {
            if ($this->tekshirish($tur, $qiymat))
            {
                $this->yigit_kun = intval($qiymat['yigit']);
                $this->qiz_kun = intval($qiymat['qiz']);
                $javob = true;
            }
            else
            {
                $this->xato .= 'Bu oyda bunday kun mavjud emas';
            }
        }

        return $javob;
        
    }


    /**
     * qiymatlarni qaytaradi
     * @param string $tur so'ralayotgan qiymat turi
     * @return array so'ralgan qiymatga mos
    */
    public function getter($tur)
    {
        /**
         * ism - ismlarni qaytaradi(array: 'yigit', 'qiz')
        */

        $javob = [];

        if ($tur == 'ism')
        {
            $javob = ['yigit' => $this->yigit_ism, 'qiz' => $this->qiz_ism];
        }
        elseif ($tur == 'yosh'){
            $javob = ['yigit' => $this->yigit_yosh, 'qiz' => $this->qiz_yosh];
        }
        elseif ($tur == 'yil')
        {
            $javob = ['yigit' => $this->yigit_yil, 'qiz' => $this->qiz_yil];
        }
        elseif ($tur == 'oy'){
            $javob = ['yigit' => $this->yigit_oy, 'qiz' => $this->qiz_oy];
        }
        elseif ($tur == 'kun')
        {
            $javob = ['yigit' => $this->yigit_kun, 'qiz' => $this->qiz_kun];
        }
        else
        {
            $this->xato .= '-- getter funksiyaning turi noto`g`ri';
        }

        return $javob;
    }

    /**
     * qiymatlarni haqiqiylikka tekshiradi
     * @param string $tur tekshirilayotgan qiymatning turi
     * @param array $qiymat qiymatlar
    */
    private function tekshirish($tur, $qiymat = null){
        $javob = false;

        if ($qiymat === null){
            $qiymat = $this->getter($tur);
        }

        $yigit = $qiymat['yigit'];
        $qiz = $qiymat['qiz'];

        if ($tur == 'ism')
        {

        }
        elseif ($tur == 'yosh')
        {
            if ($qiz >= 1 and $qiz <= 100 and $yigit >= 1 and $yigit <= 100)
                $javob = true;
        }
        elseif ($tur == 'yil')
        {
            if ($this->tekshirish('yosh'))
                $javob = true;
        }
        elseif ($tur == 'oy')
        {
            if ($qiz >= 1 and $qiz <= 12 and $yigit >= 1 and $yigit <= 12)
                $javob = true;
        }
        elseif ($tur == 'kun'){
            $oy = $this->getter('oy');
            $oylar = [
                1 => 31,
                2 => 28,
                3 => 31,
                4 => 30,
                5 => 31,
                6 => 30,
                7 => 31,
                8 => 31,
                9 => 30,
                10 => 31,
                11 => 30,
                12 => 31
            ];

            
            $yigit_max = $oylar[$oy['yigit']];            
            $qiz_max = $oylar[$oy['qiz']];

            if ($oy['yigit'] == 2)
                if ($this->getter('yil')['yigit'] % 4 == 0)
                    $yigit_max = 29;

            if ($oy['qiz'] == 2)
                if ($this->getter('yil')['qiz'] % 4 == 0)
                    $qiz_max = 29;

            
            if ($yigit >= 1 and $yigit <= $yigit_max and $qiz >= 1 and $qiz <= $qiz_max)
                $javob = true;
        }

        return $javob;
    }
}



$SevgiTest = new SevgiTest();

$SevgiTest->setter('tugilgan_sana', ['yigit' => '01.01.2000', 'qiz' => '01.01.2000']);

var_dump($SevgiTest->getter('yil'));

echo $SevgiTest->xato;
