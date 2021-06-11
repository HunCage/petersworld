<section class="m-5">
  <div class="card container p-3 m-auto w-75">
    <?php if ($params['isSuccess']) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Produkt wurde erfolgreich hinzugefügt
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>
    <!-- <#?php if ($params['editedProductId']) : ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Produkt wurde editiert
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <#?php endif; ?> -->
    <!-- <#?php if ($params['isDeleted']) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Produkt wurde gelöscht
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    <? #php endif; 
    ?>-->
    <form action="/products" method="POST" class="form-group">
      <div class="row">
        <div class="col-6">
          <input type="text" name="name" placeholder="Name" class="form-control" />
        </div>
        <div class="col-3">
          <input type="number" name="price" min="0" step="0.01" placeholder="Preis" class="form-control" />
        </div>
        <div class="col-3">
          <input class="form-control mr-2" type="number" min="0" step="0.01" name="discount" placeholder="Rabatt">
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-9">
          <input class="form-control mr-2" type="text" name="description" placeholder="Produktbeschreibung">
        </div>
        <div class="col-3">
          <input class="form-control mr-2" type="number" name="quantity" placeholder="Anzahl">
        </div>
      </div>


      <div class="row mt-3">
        <div class="col">
          <button class="btn btn-success form-control" type="submit">Senden</button>
        </div>
      </div>
    </form>

    <?php foreach ($params['products'] as $product) : ?>
      <div class="row border-top mt-2">
        <div class="col-8 mt-2">
          <h3>Name: <?= $product['name'] ?></h3>
          <hr />
        </div>
        <div class="col-4 text-right">
          <p><b>id:</b> <?= $product['id'] ?></p>
        </div>
      </div>

      <div class="row border-bottom">
        <div class="col">
          <p><b>Beschreibung: </b><?= $product['description'] ?></p>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-3 border-right">
          <p><b>Preis: </b><?= $product['price'] ?> Chf</p>
        </div>
        <div class="col-2">
          <p><b>Rabatt: </b><?= $product['discount'] ?> %</p>
        </div>
        <div class="col-3 border-right text-right">
          <?php if ($product['discount']) : ?>
            <p><b>Kaufpreis: </b><span class="text-danger font-weight-bolder"><?= $product['price'] - ($product['price'] * ($product['discount'] / 100)) ?> Chf</span></p>
          <?php else : ?>
            <p><b>Kaufreis: </b><span class="text-danger font-weight-bolder"><?= $product['price'] ?> Chf</span></p>
          <?php endif; ?>

        </div>
        <div class="col-3 text-right">
          <p><b>Anzahl: </b><?= $product['quantity'] ?> Stk.</p>

        </div>
      </div>

      <?php if ($params['editedProductId'] === $product['id']) : ?>
        <hr />
        <form class="form-group mt-3" action="/update-product?id=<?= $product["id"] ?>" method="post">
          <div class="row mb-2">
            <div class="col-9">
              <input class="form-control mr-2" type="text" name="name" placeholder="Name" value="<?= $product['name'] ?> ">
            </div>
            <div class="col-3">
              <input class="form-control mr-2" type="number" name="quantity" placeholder="Anzahl" value="<?= $product['quantity'] ?>">
            </div>
          </div>

          <div class="row">
            <div class="col">
              <input class="form-control mr-2" type="text" name="description" placeholder="Produktbeschreibung" value="<?= $product['description'] ?> ">
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-6">
              <input class="form-control mr-2" type="number" min="0" step="0.01" name="price" placeholder="Preis" value="<?= $product['price'] ?>">
            </div>
            <div class="col-6">
              <input class="form-control mr-2" type="number" min="0" step="0.01" name="discount" placeholder="Rabatt" value="<?= $product['discount'] ?>">
            </div>
          </div>


            <div class="btn-group mt-2">
              <a href="/products">
                <button class="btn btn-outline-secondary mr-2">Zurück</button>
              </a>

              <button type="submit" class="btn btn-outline-success rounded mr-2">Senden</button>
            </div>

        </form>

      <?php else : ?>

        <hr />
        <div class="btn-group mb-5">
          <a href="/products?edit=<?= $product["id"] ?>">
            <button class="btn btn-warning mr-2">Editieren</button>
          </a>

          <form action="/delete-product?id=<?= $product["id"] ?>" method="post">
            <button type="submit" class="btn btn-danger">Löschen</button>
          </form>
        </div>

      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>