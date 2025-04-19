document.addEventListener('DOMContentLoaded', function() {
    // Confirm before delete
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this product?')) {
                e.preventDefault();
            }
        });
    });
    
    // Search form validation
    const searchForm = document.querySelector('form[action="includes/search.php"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const query = this.querySelector('input[name="query"]').value.trim();
            if (query === '') {
                e.preventDefault();
                alert('Please enter a search term');
            }
        });
    }
});