<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito';
                background: #718096;
                display: flex;
                justify-content: center;
            }

            .form {
                width: 30%;
                padding: 20px 30px;
                font-weight: 700;
                position: relative;
            }

            input {
                float: right;
                width: 75%;
            }

            .price {
                display: flow-root;
            }

            .price > div {
                float: right;
                width: 75%;
            }

            .price input[name='min'],
            .price input[name='max'] {
                width: 85%;
            }

            .submit {
                display: flex;
                justify-content: end;
            }

            td,
            th {
                width: 100px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="form">
            <div>
                <label for="name" class="label">Name:</label>
                <input type="text" name="name" autocomplete="off" maxlength="150" placeholder="" class="form-control">
            </div>
            <div class="price">
                <label class="label">Price:</label>
                <div>
                    <div>
                        <label for="min" class="label">Min</label>
                        <input type="number" name="min" autocomplete="off" maxlength="150" placeholder="" class="form-control">
                    </div>
                    <div>
                        <label for="max" class="label">Max</label>
                        <input type="number" name="max" autocomplete="off" maxlength="150" placeholder="" class="form-control">
                    </div>
                </div>
            </div>
            <div>
                <label for="bedrooms" class="label">Bedrooms:</label>
                <input type="number" name="bedrooms" autocomplete="off" maxlength="150" placeholder="" class="form-control">
            </div>
            <div>
                <label for="bathrooms" class="label">Bathrooms:</label>
                <input type="number" name="bathrooms" autocomplete="off" maxlength="150" placeholder="" class="form-control">
            </div>
            <div>
                <label for="storeys" class="label">Storeys:</label>
                <input type="number" name="storeys" autocomplete="off" maxlength="150" placeholder="" class="form-control">
            </div>
            <div>
               <label for="garages" class="label">Garages:</label>
               <input type="number" name="garages" autocomplete="off" maxlength="150" placeholder="" class="form-control">
            </div>
            <div class="submit">
                <button class="form-submit" onclick="search()">Search</button>
            </div>
        </div>
        <div class="result">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Storeys</th>
                        <th>Garages</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </body>
</html>

<script>
    function search() {
        let table = document.querySelector('tbody');
        let button = document.querySelector('button');
        let url = `/search?
            name=${document.querySelector('input[name=name]').value}
            &min=${document.querySelector('input[name=min]').value}
            &max=${document.querySelector('input[name=max]').value}
            &bedrooms=${document.querySelector('input[name=bedrooms]').value}
            &bathrooms=${document.querySelector('input[name=bathrooms]').value}
            &storeys=${document.querySelector('input[name=storeys]').value}
            &garages=${document.querySelector('input[name=garages]').value}
        `;

        let ajax = new XMLHttpRequest();
        ajax.onreadystatechange = () => {
            if (ajax.readyState === 4) {
                table.innerHTML = '';
                let data = JSON.parse(ajax.response);

                if (!data.length) {
                    console.log(1);
                    table.innerHTML +=
                        '<tr><td>no result</td></tr>'
                } else {
                    data.map((item) => {
                        table.innerHTML +=
                            `<tr>
                                <td>${item.name}</td>
                                <td>${item.price}</td>
                                <td>${item.bedrooms}</td>
                                <td>${item.bathrooms}</td>
                                <td>${item.storeys}</td>
                                <td>${item.garages}</td>
                            </tr>`
                    })
                }
            }
        }
        ajax.onloadstart = () => {
            button.innerText = 'Loading';
            button.disabled = true;
        }
        ajax.onloadend = () => {
            button.innerText = 'Search';
            button.disabled = false;
        }
        ajax.open("GET", url, true);
        ajax.send();
    }
</script>
