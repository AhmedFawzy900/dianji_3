<li class="child">
    <span class="category-icon"><i class="fas fa-folder"></i></span>
    <span class="category-name">{{ $category->name }}</span>
    <span class="category-action">
        
        <a href="{{ route('category.create', ['id' => $category->id]) }}" class="text-info"><i class="fas fa-eye"></i></a>
        <a href="{{ route('category.create', ['id' => $category->id]) }}" class="text-info"><i class="fas fa-edit"></i></a>
        <!-- Delete button -->
         <a>
             <button class="text-danger delete-category" type="submit" onclick="deleteCategory({{ $category->id }})" data-id="{{ $category->id }}">
                 <i class="fas fa-trash"></i>
             </button>
         </a>

    </span>

    @if (!empty($category->subcategories) && count($category->subcategories) > 0)
    <ul>
        @foreach ($category->subcategories as $subcategory)
        @include('category.tree', ['category' => $subcategory])
        @endforeach
    </ul>
    @endif
</li>

<style>
    .delete-category{
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
    }
</style>
<!-- Add a loading spinner (optional, hidden by default) -->
<div id="loading-spinner" style="display: none;">
    <p>Processing... Please wait</p>
</div>

<script>
    // document.querySelectorAll('.delete-category').forEach(function(button) {
        
    //     button.addEventListener('click', async function(e) {
    //         e.preventDefault(); // Prevent default form submission behavior
            
    //         let categoryId = this.getAttribute('data-id');
    //         let buttonElement = this; // Reference to the clicked button

    //         // Disable the button to prevent multiple clicks
    //         buttonElement.disabled = true;

    //         // Show loading spinner
    //         document.getElementById('loading-spinner').style.display = 'block';

    //         try {
    //             // Send AJAX request to delete the single category
    //             let response = await fetch('{{ route("category.bulk-action") }}', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //                 },
    //                 body: JSON.stringify({
    //                     rowIds: categoryId, // Only the ID of the single category
    //                     action_type: 'delete' // Specify the action type
    //                 })
    //             });

    //             let data = await response.json();

    //             if (data.status) {
    //                 // Redirect after successful deletion
    //                 window.location.replace('{{ route("category.index") }}');
    //             } else {
    //                 alert('An error occurred: ' + data.message);
    //             }
    //         } catch (error) {
    //             console.error('Error:', error);
    //             alert('An error occurred while deleting the category.');
    //         } finally {
    //             // Re-enable the button and hide the loading spinner
    //             buttonElement.disabled = false;
    //             document.getElementById('loading-spinner').style.display = 'none';
    //         }
    //     });
    // });

    async function deleteCategory(categoryId) {
        // Show loading spinner
        document.getElementById('loading-spinner').style.display = 'block';

        try {
            // Send AJAX request to delete the single category
            let response = await fetch('{{ route("category.bulk-action") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    rowIds: categoryId, // Only the ID of the single category
                    action_type: 'delete' // Specify the action type
                })
            });

            let data = await response.json();

            if (data.status) {
                // Redirect after successful deletion
                window.location.replace('{{ route("category.index") }}');
            } else {
                alert('An error occurred: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while deleting the category.');
        } finally {
            // Re-enable the button and hide the loading spinner
            // document.getElementById('loading-spinner').style.display = 'none';
        }
    }
</script>

