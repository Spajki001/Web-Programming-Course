$(document).ready(function() {
    // Fetch articles on page load
    fetchArticles();

    let cart = [];

    // Event listener for the "Add to Cart" button
    $(document).on('click', '.add-to-cart-btn', function() {
        const articleId = $(this).closest('[data-article-id]').data('articleId');
        const article = $(this).closest('.card-container').find('h5').text();
        const price = parseFloat($(this).closest('.card-container').find('p').text().replace(' €', ''));
        const image = $(this).closest('.card-container').find('img').attr('src');

        // Check if the article is already in the cart
        const existingItem = cart.find(item => item.id === articleId);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                id: articleId,
                article: article,
                price: price,
                quantity: 1,
                image: image
            });
        }

        // Update the cart display
        updateCart();
    });

    $(document).on('click', '.remove-from-cart-btn', function() {
        const articleId = $(this).data('article-id');
        const existingItem = cart.find(item => item.id === articleId);
    
        if (existingItem) {
            if (existingItem.quantity > 1) {
                existingItem.quantity--;
            } else {
                cart = cart.filter(item => item.id !== articleId);
            }
        }
    
        updateCart();
    });

    // Event listener for the "Show Cart" button
    $('#showCartModal').click(function() {
        updateCart();
        $('#cartModal').modal('show');
    });

    // Event listener for the "Add Article" button
    $('#addArticle').click(function() {
        const formData = new FormData($('#addForm')[0]);

        // Send AJAX request to update the article
        fetch('add_article.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error adding article: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error adding article:', error);
        });
    });
    // Event listener for the "Save Changes" button in the edit modal
    $('#saveEdit').click(function() {
        const formData = new FormData($('#editForm')[0]);
        const articleId = $('#editModal').data('article-id');
        formData.append('articleId', articleId);

        // Send AJAX request to update the article
        fetch('update_article.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating article: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error updating article:', error);
        });
    });
    function updateCart() {
        $('#cart-items').empty();
        let total = 0;
      
        const cartTableHtml = `
          <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>Image</th>
                <th>Article</th>
                <th>Price (€)</th>
                <th>Quantity</th>
                <th>Item Total (€)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        `;
        $('#cart-items').append(cartTableHtml);
      
        const tbody = $('#cart-items').find('tbody');
      
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            const cartItemHtml = `
                <tr>
                <td><img src="${item.image}" alt="${item.article}" width="50"></td>
                <td>${item.article}</td>
                <td>${item.price.toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td>${itemTotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-sm btn-primary add-to-cart-btn" data-article-id="${item.id}">Add</button>
                    <button class="btn btn-sm btn-danger remove-from-cart-btn" data-article-id="${item.id}">Remove</button>
                </td>
                </tr>
            `;
            tbody.append(cartItemHtml);
            total += itemTotal;
        });
      
        $('#cart-total').text(total.toFixed(2) + ' €');
      }
});

function fetchArticles() {
    fetch('fetch_articles.php')
    .then(response => response.json())
    .then(data => {
        $('#article-list').html(data.html);
    })
    .catch(error => {
        console.error('Error fetching articles:', error);
    });
}

function showAddModal() {
    $('#addArticleTitle').val('');
    $('#addArticleDescription').val('');
    $('#addArticleAmount').val('');
    $('#addArticlePrice').val('');
    // Show the add modal
    $('#addModal').modal('show');
}

function showEditModal(articleId) {
    fetch('get_article_data.php?id=' + articleId)
    .then(response => response.json())
    .then(data => {
        $('#editArticleTitle').val(data.article);
        $('#editArticleDescription').val(data.description);
        $('#editArticleAmount').val(data.amount);
        $('#editArticlePrice').val(data.price);
        $('#editModal').data('article-id', articleId);
        // Show the edit modal
        $('#editModal').modal('show');
    })
    .catch(error => {
        console.error('Error fetching article data:', error);
    });
}

function showArticleDetailsModal(articleId) {
    // Fetch article data using article ID
    fetch('get_article_data.php?id=' + articleId)
      .then(response => response.json())
      .then(data => {
        $('#modalArticleTitle').text(data.article);
        $('#modalArticleDescription').text(data.description);
        $('#modalArticleAmount').text(data.amount);
        $('#modalArticlePrice').text(data.price + ' €');
        $('#modalArticleImage').attr('src', data.image_path);
        // Show the modal
        $('#articleDetailsModal').modal('show');
      })
      .catch(error => {
        console.error('Error fetching article data:', error);
      });
  }