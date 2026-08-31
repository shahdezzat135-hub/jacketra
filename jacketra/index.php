<?php
require __DIR__ . '/database.php';
$products = $pdo->query(
    'SELECT * FROM products ORDER BY id DESC'
)->fetchAll();
require __DIR__ . '/header.php';
?>

        <div id="jCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#jCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#jCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#jCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/(12).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>Best Sale</h2>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/(14).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>New Collection</h2>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/(16).webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h2>leather patina</h2>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#jCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#jCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container">
    <div class="row justify-content-between mb-3 ">
        <div class="col-8">
        <h2 class="fw-bold mt-4 text-secondary">Featured Products</h2>

        <p>  our latest picks for u.</p>
        </div>
        <div class="col-2 align-content-center " >
            <a href="Add.php" class="btn btn-outline-secondary">Add Product</a>
            <!-- <button class="btn btn-outline-secondary">View All</button> -->
        </div>
    </div>

            <div class="row">
            <section class="col-lg-12">
                <div class="row" id="jackets">
        <?php foreach ($products as $product): ?>
        <div class="col-12 col-md-6 col-lg-4 mb-2">
            <div class="card h-100 shadow-sm">
            <?php if ($product['image']): ?>
                <img
                src="uploads/<?= htmlspecialchars($product['image']) ?>"
                class="card-img-top"
                style="height:220px;object-fit:cover"
                alt=""
                >
            <?php endif; ?>
            <div class="card-body">
                <h5><?= htmlspecialchars($product['name']) ?></h5>
                <p><?= htmlspecialchars($product['description'] ?? '') ?></p>
                <p class="fw-bold">$<?= number_format($product['price'], 2) ?></p>
                <p class="<?= (int) $product['stock'] == 0 ? 'text-danger' : '' ?>">    
                    <?= (int) $product['stock'] != 0 ? 'Stock: ' . $product['stock'] : 'sold out' ?></p>
                
                <div class="d-flex justify-content-between gap-2">
                <div class="">

            <?php if ((int)$product['stock'] > 0): ?>

            <button
                type="button"
                id="buy-<?= (int)$product['id'] ?>"
                class="btn btn-outline-secondary"
                onclick="addToCart(
                    <?= (int)$product['id'] ?>,
                    <?= htmlspecialchars(json_encode($product['name'])) ?>,
                    <?= (float)$product['price'] ?>,
                    <?= (int)$product['stock'] ?>,
                    <?= htmlspecialchars(json_encode($product['image'])) ?>
                )">
                Buy
            </button>

            <div
                id="quantity-<?= (int)$product['id'] ?>"
                class="d-none align-items-center gap-2">

                <button
                    type="button"
                    class="btn btn-outline-secondary btn-sm"
                    onclick="decreaseQuantity(<?= (int)$product['id'] ?>)">
                    −
                </button>

                <span
                    id="quantity-value-<?= (int)$product['id'] ?>"
                    class="fw-bold">
                    1
                </span>

                <button
                    type="button"
                    class="btn btn-outline-secondary btn-sm"
                    onclick="increaseQuantity(<?= (int)$product['id'] ?>)">
                    +
                </button>

            </div>

        <?php else: ?>

    <button type="button" class="btn btn-outline-secondary" disabled>
        Sold out
    </button>

        <?php endif; ?>

      </div>
      <div>
        <a href="edit.php?id=<?= (int) $product['id'] ?>"
           class="btn btn-outline-secondary btn-sm ">Edit</a>


        <form action="delete.php" method="POST" class="d-inline">
          <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
          <button class="btn btn-outline-danger btn-sm "
                  onclick="return confirm('Delete this product?')">
            Delete
          </button>
        </form>
      </div>
      </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
                    
                </div>
            </section>
        </div>
</div>

    </main>
<footer class="bg-dark text-white py-4 mt-3" id="contact">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center">

        <span>© 2026 Jacketra. All rights reserved.</span>

        <div class="mt-3 mt-md-0">
            <h6 class="mb-3">Contact Us</h6>

            <p class="mb-2">
                📧 Email:
                <a href="mailto:info@jacketra.com"
                   class="text-white text-decoration-none">
                    info@jacketra.com
                </a>
            </p>

            <p class="mb-0">
                📞 Phone:
                <a href="tel:+201000000000"
                   class="text-white text-decoration-none">
                    +20 100 000 0000
                </a>
            </p>
        </div>

    </div>
</footer>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartShow" aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title">Shop Order</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
     <div id="cartItems">
        <p class="text-secondary">Your cart is currently empty.</p>
    </div>

    <hr>

    <div class="d-flex justify-content-between">
        <strong>Total:</strong>
        <strong>$<span id="cartTotal">0</span></strong>
    </div>
       </div>
        
    </div>
    <!-- TODO quick-view modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

let cart = [];
function addToCart(id, name, price, stock,image) {

    let existingProduct = cart.find(product => product.id === id);

    if (existingProduct) {

        if (existingProduct.quantity >= stock) {
            alert("You cannot add more than the available stock.");
            return;
        }

        existingProduct.quantity++;

    } else {

        cart.push({
            id: id,
            name: name,
            price: price,
            stock: stock,
            quantity: 1,
            image: image
        });
    }

    // Hide Buy button
    document.getElementById(`buy-${id}`)
        .classList.add("d-none");

    // Show quantity controls
    let quantityControls =
        document.getElementById(`quantity-${id}`);

    quantityControls.classList.remove("d-none");
    quantityControls.classList.add("d-flex");

    updateProductCard(id);
    renderCart();
    updateCartBadge();
}




function increaseQuantity(id) {

    let product = cart.find(product => product.id === id);

    if (!product) {
        return;
    }

    if (product.quantity >= product.stock) {
        alert("You cannot add more than the available stock.");
        return;
    }

    product.quantity++;

    updateProductCard(id);
    renderCart();
    updateCartBadge();
}




function decreaseQuantity(id) {

    let product = cart.find(product => product.id === id);

    if (!product) {
        return;
    }

    product.quantity--;


    // If quantity becomes 0
    if (product.quantity === 0) {

        // Remove product from cart
        cart = cart.filter(product => product.id !== id);


        // Show Buy button again
        document.getElementById(`buy-${id}`)
            .classList.remove("d-none");


        // Hide quantity controls
        let quantityControls =
            document.getElementById(`quantity-${id}`);

        quantityControls.classList.add("d-none");
        quantityControls.classList.remove("d-flex");


    } else {

        // Update quantity in product card
        updateProductCard(id);
    }


    renderCart();

    updateCartBadge();
}



function updateProductCard(id) {

    let product = cart.find(product => product.id === id);

    if (product) {

        document.getElementById(`quantity-value-${id}`)
            .textContent = product.quantity;
    }
}



function updateCartBadge() {

    let totalUnits = 0;

    cart.forEach(product => {

        totalUnits += product.quantity;

    });

    document.getElementById("cartBadge")
        .textContent = totalUnits;
}



function renderCart() {

    let cartItems = document.getElementById("cartItems");

    let cartTotal = document.getElementById("cartTotal");


    cartItems.innerHTML = "";


    // Empty cart
    if (cart.length === 0) {

        cartItems.innerHTML = `
            <p class="text-secondary">
                Your cart is currently empty.
            </p>
        `;

        cartTotal.textContent = "0";

        return;
    }


    let total = 0;


    cart.forEach(product => {

        // Calculate line total
        let lineTotal =
            product.price * product.quantity;

        // Add to grand total
        total += lineTotal;


cartItems.innerHTML += `

    <div class="border-bottom pb-3 mb-3">

        <div class="d-flex gap-3">

            <img
                src="uploads/${product.image}"
                alt="${product.name}"
                style="
                    width: 80px;
                    height: 80px;
                    object-fit: cover;
                    border-radius: 8px;
                "
            >

            <div class="flex-grow-1">

                <h5 class="mb-1">
                    ${product.name}
                </h5>

                <p class="mb-2">
                    $${Number(product.price).toFixed(2)}
                </p>

                 <div class="justify-content-between d-flex align-items-end gap-2">

                 <div> <p class="mt-2 mb-0 fw-bold">
                                    Line total:
                                    $${lineTotal.toFixed(2)}
                                </p>
                                </div>


                <div class="justify-content-end d-flex align-items-end gap-2">
                  
                    <button
                        class="btn btn-outline-secondary btn-sm"
                        onclick="decreaseQuantity(${product.id})">
                        −
                    </button>

                    <span class="fw-bold">
                        ${product.quantity}
                    </span>

                    <button
                        class="btn btn-outline-secondary btn-sm"
                        onclick="increaseQuantity(${product.id})">
                        +
                    </button>

                </div>
</div>
           

            </div>

        </div>

    </div>

`;

    });


    // Grand total
    cartTotal.textContent = total;
}

</script>
</body>

</html>

