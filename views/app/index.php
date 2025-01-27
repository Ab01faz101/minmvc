<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="min-h-100 h-auto w-full flex items-center justify-center bg-teal-lightest font-sans">
    <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-4/4 lg:max-w-2xl">
        <div class="mb-4">
            <h1 class="text-grey-darkest">Todo List</h1>
            <div class="flex mt-4">
                <input id="title" class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                       placeholder="Add Todo" name="title">
                <button onclick="store()" class="flex-no-shrink p-2 border-2 rounded text-teal border-teal cursor-pointer hover:scale-95 hover:bg-teal">
                    Add
                </button>
            </div>
        </div>
        <div id="items">

        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function getData(){
        $.ajax({
            url: "<?= url('get-todo') ?>",
            type: 'GET',
            success: function (response) {
                const todos = response.items;
                const container = $('#items'); // کانتینر اصلی HTML رو انتخاب کن
                container.empty(); // در صورت نیاز، قبلی‌ها رو پاک کن

                todos.forEach(todo => {
                    const todoHtml = `
                        <div class="flex mb-4 items-center">
                            <p class="w-full ${todo.status === 1 ? 'line-through text-green' : 'text-grey-darkest'}">${todo.title}</p>
                            ${
                        todo.status === 1
                            ? `<button onclick="changeStatus(${todo.id})" class="flex-no-shrink min-w-max p-2 ml-4 mr-2 border-2 rounded hover:scale-95 cursor-pointer text-grey border-grey hover:bg-grey">Not Done</button>`
                            : `<button onclick="changeStatus(${todo.id})" class="flex-no-shrink min-w-max p-2 ml-4 mr-2 border-2 rounded hover:scale-95 cursor-pointer text-green border-green hover:bg-green">Done</button>`
                    }
                            <button onclick="remove(${todo.id})"  class="flex-no-shrink p-2 ml-2 border-2 rounded text-red border-red hover:scale-95 cursor-pointer hover:bg-red">Remove</button>
                        </div>
                `;
                    container.append(todoHtml);
                });
            },
            error: function () {
                alert('Error loading todos.');
            }
        });
    }

    $(document).ready(function () {
        getData();
    });

    function store(){
        let title = document.querySelector("#title");
        $.ajax({
            url: "<?= url('store') ?>",
            type: 'POST',
            data: {title : title.value},
            success: function (response) {
                if (response.status == false){
                    alert(response.message);
                }
                getData();
                title.value = null;
            },
            error: function () {
                alert('Error loading todos.');
            }
        });
    }

    function changeStatus(id){
        $.ajax({
            url: "<?= url('change-status') ?>",
            type: 'POST',
            data: {id : id},
            success: function (response) {
                getData();
            },
            error: function () {
                alert('Error loading todos.');
            }
        });
    }

    function remove(id){
        $.ajax({
            url: "<?= url('remove') ?>",
            type: 'POST',
            data: {id : id},
            success: function (response) {
                getData();
            },
            error: function () {
                alert('Error loading todos.');
            }
        });
    }

</script>

<script>

</script>


</html>