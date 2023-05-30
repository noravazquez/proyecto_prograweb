<?php
require_once('config.php');
class Productos{
    var $db = null;
    public function db()
    {
        $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
        $this->db = new PDO($dsn, DBUSER, DBPASS);
    }

    public function get(){
        $this->db();
        $sql= "SELECT * FROM products";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
$producto = new Productos();
$data = $producto->get();
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos para proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
  </head>
  <body>
    <div class="container-fluid">
      <main>
        <section>
          <h4 class="titulo-card centrar-texto">Productos</h4>
            <div class="card-container">
                <?php foreach ($data as $key => $product) { ?>
                    <div class='product_wrapper'>
                    <div class='image'><img src='<?php echo $product['image']; ?>' width="20%"/>
                    </div>
                    <div class='name'><?php echo $product['name']; ?></div>
                    <div class='price'>$<?php echo $product['price']; ?></div>
                    <form method='post' action="https://www.sandbox.paypal.com/cgi-bin/webscr">

                    <!-- PayPal business email to collect payments -->
                    <input type='hidden' name='business' value='sb-mkccw15189879@business.example.com'>

                    <!-- Details of item that customers will purchase -->
                    <input type='hidden' name='item_name'
                        value='<?php echo $product['name']; ?>'>
                    <input type='hidden' name='amount'
                        value='<?php echo $product['price']; ?>'>
                    <input type='hidden' name='currency_code' value="MXN">
                    <input type='hidden' name='no_shipping' value='1'>
                    
                    <!-- PayPal return, cancel & IPN URLs -->
                    <input type='hidden' name='return' 
                        value='http://localhost/prograweb1/proyecto_prograweb/constructora/admin/return.php'>
                    <input type='hidden' name='cancel_return' 
                        value='http://localhost/prograweb1/proyecto_prograweb/constructora/admin/cancel.php'>

                    <!-- Specify a Pay Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
                    <button type='submit' class='pay'>Pay Now</button>
                    </form>
                    </div>
                <?php } ?>
            </div>
        </section>
      </main>

      <footer>
      </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>