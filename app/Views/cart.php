<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en">
<!--<![endif]-->

<!-- begin head -->
<?php echo view("head"); ?>
<!-- begin head -->

<body>

   <!-- begin head -->
   <?php echo view("header"); ?>
   <!-- begin head -->

   <div id="checkout-cart" class="container">

      <div class="row">
         <div id="content" class="col-sm-12">
            <div class="head-t mt60 mb60 text-center">
               <h4><span>Carrito de Compra</span></h4>
            </div>
            <form>
               <div class="table-responsive">
                  <?php if (empty($cart)) : ?>
                     <p>No hay productos en el carrito.</p>
                  <?php else : ?>
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Imagen</th>
                              <th>Producto</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Subtotal</th>
                              <th>Acciones</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($cart as $item) : ?>
                              <tr>
                                 <script>
                                    var item = <?= json_encode($item); ?>;
                                 </script>
                                 <td><img src="<?= site_url() . 'membresias/' . esc($item['id']) . '/' . esc($item['img']); ?>" alt="<?= esc($item['name']); ?>" style="width: 50px;"></td>
                                 <td><?= esc($item['name']); ?></td>
                                 <td><?= esc($item['qty']); ?></td>
                                 <td><?= format_number_moneda_soles(esc($item['price'])); ?></td>
                                 <td><?= format_number_moneda_soles(esc($item['qty'] * $item['price'])); ?></td>
                                 <?php $id = $item['id']; ?>
                                 <td>
                                    <div class="quantity-buttons">
                                       <button class="quantity-decrease btn" data-id="<?= $id ?>"><i class="fa fa-minus"></i></button>
                                       <button class="quantity-increase btn" data-id="<?= $id ?>"><i class="fa fa-plus"></i></button>
                                       <button class="remove-button btn btn-danger" data-id="<?= $id ?>"><i class="fa fa-trash" aria-hidden="true"></i></i></button>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  <?php endif; ?>
               </div>
            </form>
            <br />
            <!-- <div class="row">
               <div class="col-sm-4 col-sm-offset-8">
                  <table class="table table-bordered">
                     <tr>
                        <td class="text-right"><strong>Sub-Total:</strong></td>
                        <td class="text-right">$500.00</td>
                     </tr>
                     <tr>
                        <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
                        <td class="text-right">$2.00</td>
                     </tr>
                     <tr>
                        <td class="text-right"><strong>VAT (20%):</strong></td>
                        <td class="text-right">$100.00</td>
                     </tr>
                     <tr>
                        <td class="text-right"><strong>Total:</strong></td>
                        <td class="text-right">$602.00</td>
                     </tr>
                  </table>
               </div>
            </div> -->
            <div class="buttons clearfix">
               <div class="pull-left">
                  <a href="<?php echo site_url() . "productos"; ?>" class="btn btn-primary btn-custom-public">Seguir Comprando</a>
               </div>
               <div class="pull-right">
                  <a href="<?php echo site_url() . "login-register"; ?>" class="btn btn-primary btn-custom-public">Pagar</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- begin footer -->
   <?php echo view("footer"); ?>
   <!-- begin footer -->

</body>

</html>