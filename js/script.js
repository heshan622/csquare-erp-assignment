document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('item_category');
    const subcategorySelect = document.getElementById('item_subcategory');

    
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        
        subcategorySelect.innerHTML = '<option>Loading...</option>';
        subcategorySelect.disabled = true;

        if (categoryId) {
            
            fetch('php/get_subcategories.php?category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    subcategorySelect.innerHTML = '<option value="">Select a Sub Category</option>';
                    
                    
                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.sub_category_name;
                        subcategorySelect.appendChild(option);
                    });
                    
                    subcategorySelect.disabled = false;
                });
        }
    });
});