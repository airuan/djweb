<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bootui\datepicker\Datepicker;

$this->title = "试题";
?>
<div class="exam-index" style="width:60%;margin:0 auto;margin-top:50px;">
    <?php
    $questionType = [];
    $questionType[0] = "...";
    $date = date("Y-m-d");
    for ($i = 10; $i <= 50; $i += 10) {
        $questionType[$i] = "{$i} 以内";
    }

    $mth = [];
    $mth = [
        '0' => '...',
        '1' => '加法',
        '2' => '减法',
        '3' => '加减法',
        '4' => '乘法',
        '5' => '除法',
        '6' => '乘除法',
        '7' => '加减乘除',
    ];

    $form = ActiveForm::begin();


    echo $form->field($model, "type")->dropDownList($questionType, ['id' => 'type']);

    echo $form->field($model, "mth")->dropDownList($mth, [
        'id' => 'mth',
    ]);    
    echo $form->field($model, "num");
    echo $form->field($model,'date')->widget(Datepicker::className(),[
        'format' => 'yyyy-mm-dd',        
    ]);
    echo Html::submitButton("生成", ['id' => 'btn']);
    ActiveForm::end();
    ?>
    <?php
    if (Yii::$app->request->isPost) {
        $max = $model->type;
        ?>

        <div id="printDiv" style="margin-top: 20px;">		   
            <table width="90%" class="table table-bordered" border="1" style="border-collapse: collapse;border-color: #ccc;font-size: 14px">
                <tr>
                    <td colspan="3" style="height:30px;text-align:center"><?= $model->date ? $model->date : $date ?></td>
                </tr>
                <tr>
                    <td style="height:30px;">&nbsp;姓名：</td>
                    <td style="height:30px;">&nbsp;科目：数学</td>
                    <td style="height:30px;">&nbsp;得分</td>
                </tr>
                <tr>
                    <?php
                    for ($i = 0; $i < $model->num; $i++) {
                        $str = "";
                        $a = 0;
                        $b = 0;


                        if ($model->mth == 1) {
                            while (($a + $b > $max) || ($a == 0 && $b == 0)) {
                                $a = rand(0, $max);
                                $b = rand(0, $max);
                            }
                            $str = "{$a} + {$b} = ?";
                        }
                        if ($model->mth == 2) {
                            while (($a < $b) || ($a == 0 && $b == 0)) {
                                $a = rand(0, $max);
                                $b = rand(0, $max);
                            }
                            $str = "{$a} - {$b} = ?";
                        }
                        if ($model->mth == 3) {
                            $fh = "+-";
                            $fha = mb_substr($fh, rand(0, 1), 1);
                            if ($fha == "+") {
                                while (($a < $b) || ($a == 0 && $b == 0)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                                $str = "{$a} - {$b} = ?";
                            } else {
                                while (($a + $b > $max) || ($a == 0 && $b == 0)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                                $str = "{$a} + {$b} = ?";
                            }
                        }
                        if ($model->mth == 4) {
                            while (($a + $b > $max) || ($a == 0 && $b == 0)) {
                                $a = rand(0, $max);
                                $b = rand(0, $max);
                            }
                            $str = "{$a} × {$b} = ?";
                        }
                        if ($model->mth == 5) {
                            while (($a < $b) || ($b == 0) || ($a % $b > 0)) {
                                $a = rand(0, $max);
                                $b = rand(0, $max);
                            }
                            $str = "{$a} ÷ {$b} = ?";
                        }
                        if ($model->mth == 6) {
                            $fh = "×÷";

                            $fha = mb_substr($fh, rand(0, 1), 1);
                            if ($fha == "÷") {
                                while (($a + $b > $max) || ($b == 0) || ($a % $b > 0)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                            } else {
                                while (($a + $b > $max) || ($b == 0)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                            }

                            $str = "{$a} {$fha} {$b} = ?";
                        }
                        if ($model->mth == 7) {
                            $fh = "+-×÷";
                            $fha = mb_substr($fh, rand(0, 3), 1);
                            if ($fha == "÷") {
                                while (($a + $b > $max) || ($b == 0) || ($a % $b) > 0) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                            } else if ($fha == "-") {
                                while (($a + $b > $max) || ($b == 0) || ($a < $b)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                            } else {
                                while (($a + $b > $max) || ($b == 0)) {
                                    $a = rand(0, $max);
                                    $b = rand(0, $max);
                                }
                            }
                            $str = "{$a} {$fha} {$b} = ?";
                        }
                        ?>

                        <td style="height:30px;">&nbsp;<?= $str ?></td>               
                        <?php
                        if ($i == $model->num - 1) {
                            $t = ($i + 1) % 3;
                            if ($t != 0) {
                                for ($j = 0; $j < (3 - $t); $j++) {
                                    echo "<td>&nbsp;</td>";
                                }
                            }
                        }
                        if (($i + 1) % 3 == 0)
                            echo "</tr>\n<tr>";
                        ?>            
                        <?php
                        if (($i + 1) % 30 == 0 && (($i + 1) != $model->num)) {
                            ?>
                    </table>
                    <div style="page-break-after:always"></div>

                    <table width="90%" class="table table-bordered" border="1" style="border-collapse: collapse;border-color: #ccc;font-size: 14px">
                        <tr>
                            <td colspan="3" style="height:30px;text-align:center"><?= $model->date ? $model->date : $date; ?></td>
                        </tr>
                        <tr>
                            <td style="height:30px;">&nbsp;姓名：</td>
                            <td style="height:30px;">&nbsp;科目：数学</td>
                            <td style="height:30px;">&nbsp;得分</td>
                        </tr>
                        <tr>
            <?php
        }
    }
    ?>
                </tr>
            </table>
        </div>
                    <?= Html::button("打印(P)", ['id' => 'btnPrint','accessKey'=>'p']) ?>
                    <?php
                }
                ?>
</div>

<script language="javascript">
    $(document).ready(function () {
        $("#btn").off("click").on("click", function () {
            if ($("#type").find("option:selected").val() == 0) {
                alert("请选择题型！！");
                $("#type").focus();
                return false;
            }
            if ($("#mth").find("option:selected").val() == 0)
            {
                alert("请选择运算方式！");
                $("#mth").focus();
                return false;
            }
        });

        $("#btnPrint").off("click").on("click", function () {
            $("#printDiv").print({
                noPrintSelector: ".no-print",
                prepend: null,
                globalStyles: false,
                mediaPrint: false,
                stylesheet: null,
                noPrintSelector: ".no-print",
                iframe: true,
                append: null,
                prepend: null,
                manuallyCopyFormValues: false,
                noPrintSelector: ".avoid-this",
                deferred: $.Deferred(),
                timeout: 50,
                title: null,
                doctype: '<!doctype html>'
            });
        })
    });
</script>