var servicesData = {!! json_encode($services) !!};

$(document).ready(function() {
  $('#name').on('change', function() {
    var selectedName = $(this).val();

    // Clear previous category options
    $('#category').empty();

    // Filter services based on the selected name
    var filteredServices = servicesData.filter(service => service.service === selectedName);

    // Get unique categories for the selected name
    var uniqueCategories = [...new Set(filteredServices.map(service => service.service_category))];

    // Add category options to the select input
    $.each(uniqueCategories, function(index, category) {
      $('#category').append($('<option></option>').val(category).text(category));
    });
  });

  // Set the first service and its category as the default option on page load
  var initialService = servicesData[0].service;
  var initialCategory = servicesData.find(service => service.service === initialService).service_category;
  $('#name').val(initialService);

  $.each(servicesData, function(index, service) {
    if (service.service === initialService) {
      $('#category').append($('<option></option>').val(service.service_category).text(service.service_category));
    }
  });

  // Trigger the change event to show the relevant service_category
  $('#name').trigger('change');
});
