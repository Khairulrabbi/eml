<?php
    $voucher_number_auto = '';
    $voucher_number_manual = '';
    $voucher_description = '';
    $voucher_date = '';
    $voucher_debit = '';
    $voucher_credit = '';
    $acc_head_name = '';
    
//    echo '<pre>';
//    print_r($journal_voucher);
//    exit();
?>

<script type="text/javascript">
    function PrintElem(elem){
        Popup($(elem).html());
    }
    function Popup(data){
        var mywindow = window.open('', 'DISCOVERY', 'width=100');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/apsis_style.css" rel="newest stylesheet">');
        mywindow.document.write('<link href="<?php echo base_url(); ?>css/sb-admin-2.css" rel="stylesheet">');
        mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
<?php
    foreach ($journal_voucher as $value) {
        $voucher_number_auto = $value['voucher_auto_no'];
        $voucher_number_manual = $value['voucher_manual_no'];
        $voucher_description = $value['description'];
        $voucher_date = $value['journal_date'];
        $voucher_debit = $value['dr_amount'];
        $voucher_credit = $value['cr_amount'];
        $acc_head_name = $value['acc_head_name'];
    }
?>
<div id="mydiv">
    <div class="col-lg-8 col-lg-offset-2" style="margin-top: 10px;">
        <div class="col-lg-12 text-center">
            <?php
                if($voucher_debit != 0){
                    echo '<h1>Debit Voucher</h1>';
                    $amm = $voucher_debit;
                }else{
                    echo '<h1>Credit Voucher</h1>';
                    $amm = $voucher_credit;
                }
            ?>
        </div>
        <div style="width: 60%; float: left;">
            <!--Name: <?php  echo $acc_head_name; ?><br/>-->
            Account: <?php echo $acc_head_name; ?><br/>
            <!--Description: <?php echo $acc_head_name; ?><br/>-->
        </div>
        <div style="width: 38%; float: right; text-align: right;">
            Date: <?php echo $voucher_date; ?><br/>
            Voucher No.: <?php echo $voucher_number_auto; ?><br/>
            <?php 
                if(!empty($voucher_number_manual)){
                    echo 'Manual Voucher No.: '.$voucher_number_manual.'<br/>';
                }
            ?>
        </div>
        <div class="row"></div>
        <br/>
        <table class="table" style="width: 100%;">
            <tbody>
                <tr style="border-bottom: 1px solid #666; border-top: 1px solid #666;">
                    <!--<td class="text-left" style="width: 5%;"><?php echo $n; ?></td>-->
                    <td style="width: 70%;">
                        <?php echo "<b>".$voucher_description."</b>"; ?>
                    </td>
                    <td class="text-right" style="width: 20%;"><?php echo "<b>".$amm." BDT</b>"; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <?php setlocale(LC_MONETARY,"ban_BAN");?>
    <!--<div class="text-left in_word"></div>-->
</div>
<div class="col-lg-12 text-center"><br/>
    <a class="btn btn-info" id="confirm_submit" onclick="PrintElem('#mydiv')">Print</a>
</div>
<script>
$('#approve_submit').on('click',function(){
    var voucher_num = $(this).attr('vou_num');
    //alert(voucher_id);
    $.ajax({
        url: '<?php echo base_url().'accounts_configuration/voucher_approve';?>',
        method: 'post',
        data:{voucher_num: voucher_num},
        success:function(){
            location.reload();
        }
    });
});
    
$(document).ready(function(){
    var num = $('#net_bdt_amount').text();
    var vall = parseFloat(num).toFixed(2);
    var in_words = "<span class='bold'>" + toWords(vall) + "</span> BDT Only"; 
    $('.in_word').html(in_words);
});
var th = ['','Thousand','Million', 'Billion','Trillion'];
var dg = ['Zero','One','Two','Three','Four', 'Five','Six','Seven','Eight','Nine']; 
var tn = ['Ten','Eleven','Twelve','Thirteen', 'Fourteen','Fifteen','Sixteen', 'Seventeen','Eighteen','Nineteen']; 
var tw = ['Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety']; 
function toWords(s){
    s = s.toString(); 
    s = s.replace(/[\, ]/g,''); 
    if (s != parseFloat(s)) 
        return 'not a number'; 
    var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) 
            return 'too big'; 
    var n = s.split(''); 
    var str = ''; 
    var sk = 0; 
    for (var i=0; i < x; i++) {
        if ((x-i)%3==2) {
            if (n[i] == '1') {
                str += tn[Number(n[i+1])] + ' '; 
                i++; sk=1;
            } 
            else if (n[i]!=0) {str += tw[n[i]-2] + ' ';
                sk=1;
            }
        } 
        else if (n[i]!=0) {
            str += dg[n[i]] +' '; 
            if ((x-i)%3==0) str += 'Hundred ';sk=1;
        } if ((x-i)%3==1) {
            if (sk) str += th[(x-i-1)/3] + ' ';sk=0;
        }
    } 
    if (x != s.length) {
        var y = s.length; str += 'point '; 
        for (var i=x+1; i<y; i++) 
            str += dg[n[i]] +' ';
    } 
    return str.replace(/\s+/g,' ');}
</script>

<!--------------------------------->