document.addEventListener("DOMContentLoaded", () => {
  // Charger le panier depuis localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || []; // Charger ou initialiser un panier vide
  const cartItemsContainer = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");
  const cartCount = document.getElementById("cart-count");
  const cartToggle = document.getElementById("cart-toggle");
  const cartContainer = document.getElementById("cart-container");

  // Fonction pour ajouter un produit
  function addToCart(product) {
    // Vérifier si le produit existe déjà dans le panier
    const existingProduct = cart.find((item) => item.id === product.id);
    if (existingProduct) {
      existingProduct.quantity++; // Si le produit existe, augmenter la quantité
    } else {
      cart.push({ ...product, quantity: 1 }); // Sinon, ajouter un nouveau produit avec quantité 1
    }

    // Sauvegarder le panier dans localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI(); // Mettre à jour l'interface utilisateur
  }

  // Mettre à jour l'interface utilisateur du panier
  function updateCartUI() {
    cartItemsContainer.innerHTML = ""; // Réinitialiser les éléments du panier
    let total = 0;
    let count = 0;

    cart.forEach((item, index) => {
      total += item.price * item.quantity; // Calculer le total
      count += item.quantity; // Calculer le nombre total d'articles dans le panier

      // Création d'un élément pour chaque produit du panier
      const li = document.createElement("li");
      li.classList.add("flex", "justify-between", "items-center");

      li.innerHTML = `
        <span>${item.name} - ${item.price}€ x ${item.quantity}</span>
        <div class="flex items-center space-x-2">
          <button class="decrease-quantity text-gray-600" data-index="${index}">-</button>
          <span class="quantity">${item.quantity}</span>
          <button class="increase-quantity text-gray-600" data-index="${index}">+</button>
        </div>
        <button class="remove-item text-red-500 hover:text-red-700" data-index="${index}">&times;</button>
      `;

      cartItemsContainer.appendChild(li);
    });

    // Mettre à jour le total et le compteur
    cartTotal.textContent = `Total : ${total}€`;
    cartCount.textContent = count;

    // Ajouter des événements aux boutons "Supprimer" et "Changer la quantité"
    document.querySelectorAll(".remove-item").forEach((button) => {
      button.addEventListener("click", () => {
        const index = parseInt(button.dataset.index);
        removeFromCart(index);
      });
    });

    document.querySelectorAll(".increase-quantity").forEach((button) => {
      button.addEventListener("click", () => {
        const index = parseInt(button.dataset.index);
        increaseQuantity(index);
      });
    });

    document.querySelectorAll(".decrease-quantity").forEach((button) => {
      button.addEventListener("click", () => {
        const index = parseInt(button.dataset.index);
        decreaseQuantity(index);
      });
    });
  }

  // Fonction pour augmenter la quantité d'un produit
  function increaseQuantity(index) {
    cart[index].quantity++;
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
  }

  // Fonction pour diminuer la quantité d'un produit
  function decreaseQuantity(index) {
    if (cart[index].quantity > 1) {
      cart[index].quantity--;
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartUI();
    }
  }

  // Fonction pour supprimer un produit du panier
  function removeFromCart(index) {
    cart.splice(index, 1); // Retirer l'élément à l'index donné
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartUI();
  }

  // Afficher/masquer le panier
  cartToggle.addEventListener("click", () => {
    cartContainer.classList.toggle("hidden");
  });

  // Ajout des produits au panier en écoutant les événements sur les boutons "Ajouter au panier"
  document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
    button.addEventListener("click", () => {
      const product = {
        id: button.dataset.id,
        name: button.dataset.name,
        price: parseFloat(button.dataset.price),
      };
      addToCart(product); // Appeler la fonction pour ajouter le produit
    });
  });

  // Initialiser l'interface utilisateur avec le contenu du panier chargé
  updateCartUI();
});
