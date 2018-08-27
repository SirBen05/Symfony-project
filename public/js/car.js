$(() => {
  const cars = $('#cars');
  if(cars){
    cars.bind('click', (event) => {
      if(event.target.className=='btn btn-danger delete-car'){
        const id = event.target.getAttribute('car-id');
        fetch(`/symfony-project/public/car/delete/${id}`,
          {method: 'DELETE'})
          .then(res => window.location.reload());
      }
    });
  }
});