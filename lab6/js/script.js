$(document).ready(function () {
  alert("Strona załadowana!");

  $("#header").delay(3000).slideUp();

  $("#showHideBtn").click(function () {
    $("#listElement").toggle();
  });

  $("#text-color-btn").click(function () {
    const selectedColor = $("#color-select").val();
    $(".holiday-text").css("color", selectedColor);
  });

  $("#background-color-btn").click(function () {
    const selectedColor = $("#color-select").val();
    $(".holiday-text").css("background-color", selectedColor);
  });

  $("#apply-style-one").click(function () {
    $("#greeting").removeClass("style-two").addClass("style-one");
  });

  $("#apply-style-two").click(function () {
    $("#greeting").removeClass("style-one").addClass("style-two");
  });

  $("#text-input").on("change", function () {
    const inputText = $(this).val();
    $("#output-paragraph").text(inputText);
  });

  $("#thumbnail-container").on("click", "img", function() {
	const newSrc = $(this).attr("src");
	$("#main-image").attr("src", newSrc);
	});

	$("#add-task-btn").click(function() {
        const task = $("#task-input").val().trim();
        if (task !== "") {
            $("#todo-list").append(`<li>${task}</li>`);
            $("#task-input").val(""); 
        }
    });
});
