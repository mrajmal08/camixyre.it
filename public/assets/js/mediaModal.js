$(function() {

    'use strict';
  
    $("mediaDropzoneSingle").dropzone({
      url: 'crosstex.test'
    });
    $("mediaDropzoneMultiple").dropzone({
      url: 'crosstex.test'
    });
  
  });
  
  // Image Selectors
  $("#singleSelector").imagepicker();
  $("#multipleSelector").imagepicker();
  $("#attributeSelector").imagepicker();
  
  // Select Images From Modal
  $('#select-single').click(function(){
    const singleImage = $('#singleSelector').val();
    const cleanImage  = singleImage.split("media/").pop();
    $('#selected-featured').val(cleanImage);
    $('#featured-view').attr("src", "/media/" + cleanImage);
  });
  
  $('#select-multiple').click(function(){
    const multipleImage = $('#multipleSelector').val();
    const countImages = multipleImage.length;
    var imagesList = "";
    multipleImage.forEach(function(value, index){
      const cleanImages  = value.split("media/").pop();
      imagesList += cleanImages + "|";
    });
    $('#selected-multiple').val(imagesList);
    $('#count-multiple').text(countImages + " Images Selected");
  });