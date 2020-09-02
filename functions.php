<?php

include_once('summary.php');
//function podatek($year){
//        if($year = 2017){
//            $podatek = kwota_podatku(podatek_2017($podstawa));
//        }
//	
//        if($year = 2018){
//            $podatek = kwota_podatku(podatek_2018($podstawa));
//        }
//        if($year = 2019){
//            $podatek = kwota_podatku(podatek_2019($podstawa));
//        }
//        return $podatek;
//}
if(!function_exists('wysokosc_podatku')){
function wysokosc_podatku($dochod){
           $kwota_podatku = $dochod * 0.91;
           return $kwota_podatku;
        }
}
if(!function_exists('podatek_2019')){
function podatek_2019($podstawa){
		 
		if($podstawa <= 8000){
			$wartosc_podatku = 0;
		}
			else if($podstawa >= 8001 AND $podstawa <= 13000){
				$x1 = 1440 - 883.98 * ($podstawa - 8000) /5000;
				$wartosc_podatku = ($podstawa * 0.18) - $x1;
			}	
				else if($podstawa >= 13001 AND $podstawa <= 85528){
					$x2 = 556.02;
					$wartosc_podatku = ($podstawa * 0.18) - $x2;
				}
					else if($podstawa >= 85529 AND $podstawa <= 127000){
						$x3 = 556.02 - 556.02 * ($podstawa - 85528)/41472;
						$wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32 - $x3;
					}
						else if($podstawa >= 127001){
							$wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32;
							
						}
					
		return round($wartosc_podatku, 2);
	}
}
if(!function_exists('podatek_2018')){
function podatek_2018($podstawa){

        if($podstawa <= 8000){
                $wartosc_podatku = 0;
        }
                else if($podstawa >= 8001 AND $podstawa <= 13000){
                        $x1 = 1440 - 883.98 * ($podstawa - 8000) /5000;
                        $wartosc_podatku = ($podstawa * 0.18) - $x1;
                }	
                        else if($podstawa >= 13001 AND $podstawa <= 85528){
                                $x2 = 556.02;
                                $wartosc_podatku = ($podstawa * 0.18) - $x2;
                        }
                                else if($podstawa >= 85529 AND $podstawa <= 127000){
                                        $x3 = 556.02 - 556.02 * ($podstawa - 85528)/41472;
                                        $wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32 - $x3;
                                }
                                        else if($podstawa >= 127001){
                                                $wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32;

                                        }

        return round($wartosc_podatku, 2);
}
}
if(!function_exists('podatek_2017')){
        function podatek_2017($podstawa){
		 
		if($podstawa <= 6000){
			$wartosc_podatku = 0;
		}
			else if($podstawa >= 6001 AND $podstawa <= 11000){
				$x1 = 1188 - 661.98 * ($podstawa - 6600) / 4400;
				$wartosc_podatku = ($podstawa * 0.18) - $x1;
			}	
				else if($podstawa >= 11001 AND $podstawa <= 85528){
					$x2 = 556.02;
					$wartosc_podatku = ($podstawa * 0.18) - $x2;
				}
					else if($podstawa >= 85529 AND $podstawa <= 127000){
						$x3 = 556.02 - 556.02 * ($podstawa - 85528)/41472;
						$wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32 - $x3;
					}
						else if($podstawa >= 127001){
							$wartosc_podatku = 15395.04 + ($podstawa - 85528) * 0.32;
							
						}
					
		return round($wartosc_podatku, 2);
	}
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

