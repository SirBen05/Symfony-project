$(() => {
    const fruit = $('#fruit');
    if(fruit){
      fruit.bind('click', (event) => {
        if(event.target.className=='btn btn-danger delete-fruit'){
          const id = event.target.getAttribute('fruit-id');
          fetch(`/symfony-project/public/fruit/delete/${id}`,
            {method: 'DELETE'})
            .then(res => window.location.reload());
        }
      });
    }
  });