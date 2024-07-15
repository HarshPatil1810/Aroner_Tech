<!DOCTYPE html>
<html>
<head>
    <title>Tabbed Form</title>
    <style>
        .tab {
            display: none;
        }
        .tab-header {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
        }
        .tab-header div {
            padding: 10px;
            cursor: pointer;
        }
        .tab-header .active {
            background-color: #ccc;
        }
        .tab.active {
            display: block;
        }
    </style>
    <script>
        function showTab(n) {
            var tabs = document.getElementsByClassName('tab');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }
            tabs[n].classList.add('active');

            var headers = document.getElementsByClassName('tab-header-item');
            for (var i = 0; i < headers.length; i++) {
                headers[i].classList.remove('active');
            }
            headers[n].classList.add('active');
        }
    </script>
</head>
<body>
    <div class="tab-header">
        <div class="tab-header-item active" onclick="showTab(0)">PERSONAL DETAILS</div>
        <div class="tab-header-item" onclick="showTab(1)">CATEGORY AND SUBCATEGORY</div>
        <div class="tab-header-item" onclick="showTab(2)">QUALIFICATION AND CERTIFICATION</div>
        <div class="tab-header-item" onclick="showTab(3)">Listing Plan</div>
        <div class="tab-header-item" onclick="showTab(4)">LICENSE DETAILS</div>
        <div class="tab-header-item" onclick="showTab(5)">FOR HR PURPOSE ONLY</div>
    </div>

    <form method="post" action="employee-joining-form.php">
        <div class="tab active" id="tab1">
            <h2>PERSONAL DETAILS</h2>
            <input type="text" name="personal_details" placeholder="Personal Details">
        </div>
        <div class="tab" id="tab2">
            <h2>CATEGORY AND SUBCATEGORY</h2>
            <input type="text" name="category_subcategory" placeholder="Category and Subcategory">
        </div>
        <div class="tab" id="tab3">
            <h2>QUALIFICATION AND CERTIFICATION</h2>
            <input type="text" name="qualification_certification" placeholder="Qualification and Certification">
        </div>
        <div class="tab" id="tab4">
            <h2>Listing Plan</h2>
            <input type="text" name="listing_plan" placeholder="Listing Plan">
        </div>
        <div class="tab" id="tab5">
            <h2>LICENSE DETAILS</h2>
            <input type="text" name="license_details" placeholder="License Details">
        </div>
        <div class="tab" id="tab6">
            <h2>FOR HR PURPOSE ONLY</h2>
            <input type="text" name="hr_purpose" placeholder="For HR Purpose Only">
        </div>

        <input type="submit" value="Submit">
    </form>
</body>
</html>