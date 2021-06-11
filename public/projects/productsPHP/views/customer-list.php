<section class="m-5">
    <div class="card container p-3 m-auto w-75">
        <?php if ($params['isSuccess']) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Account wurde erstellt
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form action="/customers" method="POST" class="form-group">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="firstname" placeholder="Vorname" class="form-control" />
                </div>
                <div class="col-6">
                    <input type="text" name="lastname" placeholder="Nachname" class="form-control" />
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-5">
                    <input class="form-control mr-2" type="text" name="street" placeholder="Strasse">
                </div>
                <div class="col-5">
                    <input class="form-control mr-2" type="text" name="city" placeholder="Stadt">
                </div>
                <div class="col-2">
                    <input class="form-control mr-2" type="text" name="zipCode" placeholder="Postleitzahl">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <button class="btn btn-success form-control" type="submit">Senden</button>
                </div>
            </div>
        </form>

        <?php foreach ($params['customers'] as $customer) : ?>
            <div class="row border-top mt-3">
                <div class="col-8  mt-3">
                    <h3>Name: <?= $customer['firstname'] ?> <?= $customer['lastname'] ?></h3>
                    <hr />
                </div>
                <div class="col-4 text-right">
                    <p><b>id:</b> <?= $customer['id'] ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-3 border-right">
                    <p>Strasse: <?= $customer['street'] ?></p>
                </div>
                <div class="col-2">
                    <p>Stadt: <?= $customer['city'] ?></p>
                </div>
                <div class="col-3 border-right">
                </div>
                <div class="col-3 text-right">
                    <p>Postleitzahl: <?= $customer['zipCode'] ?></p>
                </div>
            </div>



            <?php if ($params['editedCustomerId'] === $customer['id']) : ?>

                <form class="form-group" action="/update-customer?id=<?= $customer["id"] ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="firstname" placeholder="Vorname" class="form-control mr-2" value="<?= $customer['firstname'] ?>" />
                        </div>
                        <div class="col-6">
                            <input type="text" name="lastname" placeholder="Nachname" class="form-control mr-2" value="<?= $customer['lastname'] ?>" />
                        </div>
                    </div>

                    <div class="row mt-2 mb-2">
                        <div class="col-5">
                            <input class="form-control" type="text" name="street" placeholder="Strasse" value="<?= $customer['street'] ?>" />
                        </div>
                        <div class="col-5">
                            <input class="form-control" type="text" name="city" placeholder="Stadt" value="<?= $customer['city'] ?>" />
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="text" name="zipCode" placeholder="Postleitzahl" value="<?= $customer['zipCode'] ?>" />
                        </div>
                    </div>

                    <a href="/customers">
                        <button class="btn btn-outline-secondary mr-2">Zurück</button>
                    </a>

                    <button type="submit" class="btn btn-outline-success mr-2">Senden</button>
                </form>

            <?php else : ?>

                <hr />
                <div class="btn-group mb-5">
                    <a href="/customers?edit=<?= $customer["id"] ?>">
                        <button class="btn btn-warning mr-2">Editieren</button>
                    </a>

                    <form action="/delete-customer?id=<?= $customer["id"] ?>" method="post">
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>