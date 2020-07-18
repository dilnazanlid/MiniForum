var postId = 0;

function likeFunction(postId, islike){
  $.ajax({
    method:'POST',
    url: urlLike,
    data: {islike: islike, postId: postId, _token: token}
  }).done(function(data){
    if(islike == 0){
      $('.dislikebutton' + postId).attr("fill", "#000000");
      if($('.likebutton' + postId).attr('fill') === "#FF0000"){
        $('.likebutton' + postId).attr("fill", "#000000");
      }else{
        $('.likebutton' + postId).attr("fill", "#FF0000");
      }
    }else{
      $('.likebutton' + postId).attr("fill", "#000000");
      if($('.dislikebutton' + postId).attr('fill') == '#FF0000'){
        $('.dislikebutton' + postId).attr("fill", "#000000");
      }else{
        $('.dislikebutton' + postId).attr("fill", "#FF0000");
      }
    }

    $('.countLikes' + postId).text(data[0]);
    $('.countDislikes' + postId).text(data[1]);

  });
  return false;
}

// $('.like').on('click', function(event){
//
//   postId = event.target.parentNode.parentNode.parentNode.id;
//   console.log(postId);
//   var islike = event.target.previousElementSibling == null;
//   $.ajax({
//     method:'POST',
//     url: urlLike,
//     data: {islike: islike, postId: postId, _token: token}
//   }).done(function(data){
//     //event.target.innerText = islike ? event.target.innerText == "Like" ? "Liked" : "Like" : event.target.innerText == "Dislike" ? "Disliked" :'Dislike';
//
//     if(islike){
//       if($('.likebutton' + postId).css.fill == '#FF0000'){
//         $('.likebutton' + postId).css({ fill: "#000000" });
//       }else{
//         $('.likebutton' + postId).css({ fill: "#FF0000" });
//       }
//     }else{
//       if($('.dislikebutton' + postId).css.fill == '#FF0000'){
//         $('.dislikebutton' + postId).css({ fill: "#000000" });
//       }else{
//         $('.dislikebutton' + postId).css({ fill: "#FF0000" });
//       }
//     }
//
//     if(islike){
//       //event.target.nextElementSibling.innerText = "Dislike";
//       $('.dislikebutton' + postId).css({ fill: "#000000" });
//     }else{
//       //event.target.previousElementSibling.innerText = "Like";
//       $('.likebutton' + postId).css({ fill: "#000000" });
//     }
//     $('.countLikes' + postId).text(data[0]);
//     $('.countDislikes' + postId).text(data[1]);
//
//   });
//   return false;
// });
