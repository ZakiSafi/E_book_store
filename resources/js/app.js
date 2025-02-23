// Import jQuery and attach it to the global window object
import $ from "jquery";
window.$ = window.jQuery = $;

// Import Select2 (it will now have access to window.jQuery)
import "select2";

// Initialize Select2 on your select elements
$(document).ready(function () {
    $(".select2").select2();
});

// Import other dependencies
import "./bootstrap";
import "./index";
import "font-awesome/css/font-awesome.css";
