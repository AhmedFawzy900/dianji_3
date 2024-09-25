<div class="">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="text-align: right;">الفئات</h2>
            <input type="text" id="categorySearch" placeholder="ابحث عن فئة..." class="form-control mb-3" style="direction: rtl; text-align: right;">
            <ul id="categoryTree" style="direction: rtl;">
                @foreach ($categories as $category)
                    @include('category.tree', ['category' => $category])
                @endforeach
            </ul>
        </div>
    </div>
</div>


<style>
ul{
list-style-type: none !important;
}
ul#categoryTree {
    border-right: 1px solid #ccc;
    list-style-type: none;
    padding-right: 20px;
    padding-left: 0;
    direction: rtl;
}

#categoryTree li {
    margin-bottom: 5px;
    position: relative;
}

ul#categoryTree li:before {
    content: '';
    position: absolute;
    right: -20px;
    top: 0px;
    height: 15px;
    width: 15px;
    border-bottom: 1px solid #ccc;
}


ul#categoryTree ul li:before {
    border-right: 1px solid #ccc;
}

.hidden {
    display: none ;
}

.card-title {
    font-size: 24px;
    font-weight: bold;
}

input#categorySearch {
    text-align: right;
}

#categoryTree span {
    cursor: pointer;
    font-size: 16px;
}
ul#categoryTree li span a {
    color: white;
    margin: 0;
    padding: 2px;
    font-size: 10px;
    display: none;
}

ul#categoryTree li:hover a {
    display: inline;
}
</style>

<script>
document.querySelectorAll('.child').forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.stopPropagation();
        let children = this.querySelector('ul');
        if (children) {
            children.classList.toggle('hidden');
        }
    });
});

// Filter categories based on search input
document.getElementById('categorySearch').addEventListener('keyup', function() {
    let filter = this.value.toUpperCase();
    let categories = document.querySelectorAll('#categoryTree .child');

    categories.forEach(function(category) {
        let text = category.querySelector('span').textContent || category.querySelector('span').innerText;
        if (text.toUpperCase().indexOf(filter) > -1) {
            category.style.display = "";
        } else {
            category.style.display = "none";
        }
    });
});
</script>
