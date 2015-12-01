<?php
function inputs(){
    echo "
        ---------title----------\n
        ------1.Fibonacci------\n
        ------2.Matrix multiplication problem ------\n
        ------3.Eight coins------\n
        ------4.Heap sort problem-------\n
        ------5.Full source shortest path problem------\n
        ";
    echo "please enter the number :\n>";
    $head = fopen("php://stdin","r");
    $hand = fgets($head);
    return $hand;
}
mains();

function mains(){
    $getnumber = inputs();
    switch ($getnumber) {
        case 1:
            $newFei = new Feibo();
            $newFei->feimain();
            echo "Whether to continue(1 continue,0 not continue): 1/0 \n";
            $YorN = fopen("php://stdin","r");
            $state = fgets($YorN);
            juage($state);
            break;
        case 2:
            $Mat = new Matrix();
            $Mat ->Mmain();
            echo "Whether to continue(1 continue,0 not continue): 1/0 \n";
            $YorN = fopen("php://stdin","r");
            $state = fgets($YorN);
            juage($state);
            break;        
        case 3:
            $coin = new Coin();
            $coin ->Cmain();
            echo "Whether to continue(1 continue,0 not continue): 1/0 \n";
            $YorN = fopen("php://stdin","r");
            $state = fgets($YorN);
            juage($state);
            break;
        case 4:
            $Heap = new HeapSort();
            $Heap->Hmain();
            echo "Whether to continue(1 continue,0 not continue): 1/0 \n";
            $YorN = fopen("php://stdin","r");
            $state = fgets($YorN);
            juage($state);
            break;
        case 5:
            # code...
            break;
        default :
            echo "error ".$getnumber;
            break;
    }
}

function juage($str){
    if ($str==1) {
        mains();

    }else{
        return false;
    }
}

//Fibonacci类
class Feibo
{
    private $num;//私有变量获取选项
    function __construct(){}
    //主函数入口
    function feimain(){
        echo "
            1.Recursive------\n
            2.Recursive algorithm------\n
            3.exit------\n
        ";//选择算法模式
        $selectN = fopen("php://stdin","r");
        $this->num = fgets($selectN);
        switch ($this->num) {
            case 1:
                echo "please enter the number of N: \n";
                $feiboN =fopen("php://stdin","r");
                $feiboNum = fgets($feiboN);
                $result =$this->Fei($feiboNum);
                echo $result."\n"; 
                break;
            case 2:
                echo "please enter the number of N: \n";
                $feiboN =fopen("php://stdin","r");
                $feiboNum = fgets($feiboN);
                $result =$this->Feib($feiboNum);
                echo $result."\n"; 
                break;                
            default:
                echo "error ".$this->num;
                break;
        }
    }
    //递归算法
    public function Fei($n){
        if ($n<0) {
            return false;
        }else if($n==0){
            return 0;
        }else if ($n==1) {
            return 1;
        }else{
            return $this->Fei($n-1)+$this->Fei($n-2);
        }
    }
    //迭代算法
    public function Feib($n){
        $f0 = 0;
        $f1 = 1;
        $fei = 1;
        // 开始时间
        for ($i=2; $i <=$n ; $i++) { 
            $fei = $f1+$f0;
            $f0 = $f1;
            $f1 = $fei;
        }
        //结束时间
        return $fei;
    }
}

//矩阵类
class Matrix
{
    /*by zhaoxinglai 
    *@param (int) $Mnum 是选择操作码
    *@param (array) $Matrix1,$Matrix2,$Matrix3 三个数组存放三个矩阵
    *@param (int) $colN
    */

    private $Mnum;

    private $Matrix1,$Matrix2,$Matrix3;

    private $colN;

    function __construct(){}
    // 矩阵函数主体
    public function Mmain(){
        echo "
            1.the function of BF \n
            2.the function of DAC\n
            please enter number of n : \n";
        $MatN = fopen("php://stdin","r");
        $this->Mnum = fgets($MatN);
        switch ($this->Mnum) {
            case 1:
                 $this->BF();
                break;
            case 2:
                $this->DAC();
                break;
            default:
                echo "error message ".$this->Mnum;
                break;
        }
    }
    public function initarray(){
        $this->colN = rand(1,9);
        for ($i=0; $i < $this->colN ; $i++) { 
            for ($j=0; $j < $this->colN; $j++) { 
                $this->Matrix1[$i][$j] = rand(0,9);
            }
        }
        for ($i=0; $i < $this->colN; $i++) { 
            for ($j=0; $j <$this->colN; $j++) { 
                $this->Matrix2[$i][$j] = rand(0,9);
            }
        }
    }
    //蛮力法求解矩阵相乘
    public function BF(){
        $this->initarray();
        // 打印生成的第一个矩阵
        var_dump($this->Matrix1);
        //打印生成的第二个矩阵
        var_dump($this->Matrix2);
        
        //实现矩阵相乘
        for ($i=0; $i < $this->colN; $i++) { 
            for ($j=0; $j < $this->colN; $j++) { 
                $this->Matrix3[$i][$j] = 0;//初始化第结果集
                for ($k=0; $k < $this->colN; $k++) { 
                    //将结果集赋值到对应的位置
                    $this->Matrix3[$i][$j] =$this->Matrix3[$i][$j] + $this->Matrix1[$i][$k]*$this->Matrix2[$k][$j];
                    // echo $this->Matrix3[$i][$j]."\n";
                }
            }
        }
        //打印输出最终的结果
        var_dump($this->Matrix3);
    }
    //分治法求矩阵相乘问题
    public function DAC(){

    }
}


/*
    *减治法，八枚硬币问题
    *@param  $arr1,$array,$arr2,$arr3 the typeof array

*/
class Coin
{
    /*
    @ by zhaoxinglai
    */ 
    private $array;//初始化数组
    private $arr1;//分组1，该组分3个
    private $arr2;//分组2，该组分三个
    private $arr3;//分组3，该组分两个
    private $temp;//用于交换的变量
    private $sum1=0,$sum2=0;//和
    public function __construct(){}
    //初始化数组
    public function init(){
        for ($i=0; $i <8 ; $i++) { 
            $this->array[$i] = 1;//让所有的都是真硬币
        }
        $j = rand(0,7);//随机产生一个位置，放假币
        $this->array[$j] = 0;//添加一枚假币到数组
        $k = 0;
        // 进行分组 分别给arr1 arr2 arr3 分硬币个数为3 3 2 
        while ($k<=2) {  
            $this->arr1[$k] = $this->array[$k];
            $this->arr2[$k] = $this->array[$k+3];
            $k++;
        }
        $k= 0;
        while ($k<=1) {
            $this->arr3[$k] =  $this->array[$k+6];
            $k++;
        }
    }
    public function Cmain(){
        $this->init();
        var_dump($this->array);
        $j = 0;
        $slag;
        while ($j<=2) {
            $this->sum1 = $this->sum1+$this->arr1[$j];//求第一组的和
            $this->sum2 = $this->sum2 + $this->arr2[$j];//求第二组的和
            $j++;
        }
        if ($this->sum1!=$this->sum2) {
            $j = 0;
            $this->sum1 = 0;$this->sum2 = 0;
            while ($j<2) {
                $this->sum1 = $this->sum1 + $this->arr1[$j];//求第一组前两个的和
                $this->sum2 = $this->sum2 + $this->arr2[$j];//求第二组前两个的和
                $j++;
            }
            if ($this->sum1 == $this->sum2) {//判断一二组前两个值是不是相等
                if ($this->arr1[0] ==$this->arr1[2]) {
                    echo "the error coin place of : 6\n";
                }else{
                    echo "the error coin place of : 3 \n";
                }
            }else{
                //如果是sum1大于sum2 标记1，小于标记0
                if ($this->sum1>$this->sum2) {
                    $slag = 1;
                }else{
                    $slag = 0;
                }
                //缩小范围，交换数组中的元素位置作比较
                $this->temp = $this->arr1[1];
                $this->arr1[1] = $this->arr2[1];
                $this->arr2[1] = $this->temp;
                $this->sum1 = 0;
                $this->sum2 = 0;
                $j = 0;
                while($j<=1){
                    $this->sum1 = $this->sum1 + $this->arr1[$j];
                    $this->sum2 = $this->sum2 + $this->arr2[$j];
                }
                if ($this->sum1>$this->sum2) {
                    $slag1 = 1;
                }else{
                    $slag1 = 0;
                }
                if ($slag == $slag1) {
                    if ($this->arr1[0] == $this->arr1[1]) {
                           echo "the error coin place of : 4 \n";
                    }else{
                        echo "the error coin place of : 1 \n";
                    }   
                }else{
                    if ($this->arr1[0] == $this->arr1[1]) {
                        echo  "the error coin place of : 5 \n";
                    }else{
                        echo "the error coin place of : 2 \n";
                    }
                }
            }
        }else{
            if ($this->arr3[0]==$this->arr1[0]) {
                echo "the error coin place of : 8 \n";
            }else{
                echo "the error coin place of : 7 \n";
            }
        }
    }
}

/*
* 变治法堆排序问题 
*   需要理解的概念：
*   变治法
*   堆
*   堆排序
*/
class HeapSort
{   
    /*
    *@function heapSort() 堆排序
    *@function initHeap(&$arr) 初始化最大堆
    *@function ajustNodes(&$arr, $start, $end) 调整堆
    */ 
    private $arr;//预排序数组
    public function __construct(){}
    public function initA(){
        for ($i=0; $i <10 ; $i++) { 
            $this->arr[$i] = rand(1,50);
        }
    }
    public function Hmain(){
        $this->initA();
        var_dump($this->arr);
        $Result = $this->heapSort($this->arr);
        var_dump($Result);
    }
    public function heapSort(&$arr) {
        // 初始化大顶堆
        $this->initHeap($arr, 0, count($arr) - 1);
        //开始交换首尾节点,并每次减少一个末尾节点再调整堆,直到剩下一个元素
        for($end = count($arr) - 1; $end > 0; $end--) {
            $temp = $arr[0];
            $arr[0] = $arr[$end];
            $arr[$end] = $temp;
            $this->ajustNodes($arr, 0, $end - 1);
        }
        return $arr;
    } 
    //初始化最大堆,从最后一个非叶子节点开始,最后一个非叶子节点编号为 数组长度/2 向下取整
    public function initHeap(&$arr) {
        $len = count($arr);
        for($start = floor($len / 2) - 1; $start >= 0; $start--) {
            $this->ajustNodes($arr, $start, $len - 1);
        }
    }
         
    /*调整节点
    *@param $arr    待调整数组
    *@param $start    调整的父节点坐标
    *@param $end    待调整数组结束节点坐标
    */
    public function ajustNodes(&$arr, $start, $end) {
        $maxInx = $start;
        $len = $end + 1;    //待调整部分长度
        $leftChildInx = ($start + 1) * 2 - 1;    //左孩子坐标
        $rightChildInx = ($start + 1) * 2;    //右孩子坐标
        //如果待调整部分有左孩子
        if($leftChildInx + 1 <= $len) {
            //获取最小节点坐标
            if($arr[$maxInx] < $arr[$leftChildInx]) {
                $maxInx = $leftChildInx;
            }
             
            //如果待调整部分有右子节点
            if($rightChildInx + 1 <= $len) {
                if($arr[$maxInx] < $arr[$rightChildInx]) {
                    $maxInx = $rightChildInx;
                }
            }
        }
        //交换父节点和最大节点
        if($start != $maxInx) {
            $temp = $arr[$start];
            $arr[$start] = $arr[$maxInx];
            $arr[$maxInx] = $temp;
             
            //如果交换后的子节点还有子节点,继续调整
            if(($maxInx + 1) * 2 <= $len) {
                $this->ajustNodes($arr, $maxInx, $end);
            }
        }
    }
}
 ?>

