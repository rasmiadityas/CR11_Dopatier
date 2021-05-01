<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<style type="text/css">
    body {
        color: #566787;
        background: #fff;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .btn {
        font-weight: 800;
        border: 2px solid;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 50px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #fff;
        color: black;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h1 {
        margin: 5px 0 0;
        font-size: 40px;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 32px;
        font-weight: bold;
    }

    .table-title h3 {
        margin: 15px 0 0;
        font-size: 18px;
        color: #566787;
    }

    .table-title .btn {
        color: #566787;
        float: right;
        font-size: 13px;
        background: #fff;
        border-color: #566787;
        min-width: 50px;
        border-radius: 2px;
        margin-left: 10px;
    }

    .table-title .btn:hover,
    .table-title .btn:focus {
        color: #566787;
        background: #f2f2f2;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 5px 5px;
        vertical-align: middle;
        text-align: center;
    }

    table.table tr th:first-child {
        width: 30px;
    }

    table.table tr th:last-child {
        width: 150px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a.view {
        color: #2196F3;
    }

    table.table td a.edit {
        color: #FFC107;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td a.pubmed {
        color: #5C9C63;
    }

    table.table td a:hover {
        color: #566787;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin: 5px 5px 5px 0;
        width: 50px;
        height: 50px;
    }

    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    .text-success {
        color: #10c469;
    }

    .text-info {
        color: #62c9e8;
    }

    .text-warning {
        color: #FFC107;
    }

    .text-danger {
        color: #ff5b5b;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a,
    .pagination li.active a.page-link {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 40%;
    }

    .field-register {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }

    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;
    }

    .img-navbar {

        height: 30px !important;
    }

    .medtype {
        color: #DF9D00;
        font-weight: bold;
        font-size: 20px;
    }

    .available {
        color: MediumSeaGreen;
        font-weight: bold;
        font-size: 16px;
    }

    .reserved {
        color: Tomato;
        font-weight: bold;
        font-size: 16px;
    }

    .owned {
        color: #136add;
        font-weight: bold;
        font-size: 16px;
    }

    .btn btn-outline-* {
        border-width: 2px;
    }

    .userImage {
        width: 100px;
        height: auto;
        margin-top: 1.5rem;
    }

    .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-success {
        --bs-table-bg: #DCE6EC;
    }
</style>