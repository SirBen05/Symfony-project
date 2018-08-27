$(() => {
  //alert('Hey Jude, you don\' look bad');
  const articles = $('#articles');
  if (articles){
    articles.bind('click', (event) =>{
      if (event.target.className =='btn btn-danger delete-article'){
        if(confirm('Are you sure?')){
          const id = event.target.getAttribute('article-id');
          //alert(id);
          fetch(`/symfony-project/public/article/delete/${id}`,
            {method: 'DELETE'}
          ).then(response => window.location.reload())
        }
      }
    });
  }
});