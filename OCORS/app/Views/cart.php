

<div class="container-cart">
            <div class="card">
                <div class="row">
                    <div class="col-md-8 cart">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h4 style="color: white;"><b>Cart</b></h4>
                                </div>
                                <div class="col align-self-center text-right text-muted"><?php echo count($cart)." "; echo $a = count($cart) > 1 ? "items": "item" ?></div>
                            </div>
                        </div>
                        <?php 
                        
                            foreach($cart as $isi){
                                // dd($isi);
                                $id = $isi['barang']['id'];
                                $src = base_url('img').'/'.$isi['barang']['coverImage'];
                                $isi['harga'] = $isi['barang']['harga'] * $isi['qty'];
                                $totalHarga = $isi['harga'];
                                $cart[$id]['harga'] = $totalHarga;
                                $minus = base_url('cart/decreaseorincrease').'/'.$isi['barang']['id'].'/0';
                                $plus = base_url('cart/decreaseorincrease').'/'.$isi['barang']['id'].'/1';
                                echo <<<EOT
                                <div class="row border-top border-bottom">
                                    <div class="row main align-items-center">
                                        <div class="col-2"><img class="img-fluid" src="$src"></div>
                                        <div class="col">
                                            <div class="row" style="color: white;">{$isi['barang']['nama']}</div>
                                        </div>
                                        <div class="col"> <a href="$minus" style="color: white;">-</a> <a href="#" style="color: white;">{$isi['qty']}</a> <a href="$plus" style="color: white;">+</a> </div>
                                        <div class="col" style="color: white;">&dollar; {$totalHarga} <span class="close" style="color: white;">&#10005;</span></div>
                                    </div>
                                </div>
                                EOT;
                            }
                        
                        ?>
                        <!-- <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="img/7.png"></div>
                                <div class="col">
                                    <div class="row" style="color: white;">Jujutsu Kaisen</div>
                                </div>
                                <div class="col"> <a href="#" style="color: white;">-</a><a href="#" style="color: white;">1</a><a href="#" style="color: white;">+</a> </div>
                                <div class="col" style="color: white;">&dollar; 5 <span class="close" style="color: white;">&#10005;</span></div>
                            </div>
                        </div> -->
                        <!-- <div class="row">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="img/8.png"></div>
                                <div class="col">
                                    <div class="row" style="color: white;">Kimetsu No Yaiba</div>
                                </div>
                                <div class="col"> <a href="#" style="color: white;">-</a><a href="#" style="color: white;">1</a><a href="#" style="color: white;">+</a> </div>
                                <div class="col" style="color: white;">&dollar; 5,6 <span class="close" style="color: white;">&#10005;</span></div>
                            </div>
                        </div>
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="img/chainsaw.png"></div>
                                <div class="col">
                                    <div class="row" style="color: white;">Chainsaw Man</div>
                                </div>
                                <div class="col"> <a href="#" style="color: white;">-</a><a href="#" style="color: white;">1</a><a href="#" style="color: white;">+</a> </div>
                                <div class="col" style="color: white;">&dollar; 5,6 <span class="close" style="color: white;">&#10005;</span></div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-4 summary">
                    <form method="POST" action="<?=base_url('cart/payment')?>">
                        <div class="row" style="border-top: 2px solid #262626; padding: 2vh 0;">
                            <div class="col" style="color: white;">TOTAL PRICE</div>
                            <div class="col text-right" style="color: white;">&dollar; <?php 
                                $harga = 0;
                                // dd($cart);
                                foreach($cart as $isi){
                                    $harga += $isi['harga'];
                                }
                        
                                echo $harga;
                            ?></div>
                        </div> <button class="btn">CHECKOUT</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>