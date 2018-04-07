function Resource(baseUrl, resourceName) {
    this.baseUrl = baseUrl;
    this.resourceName = resourceName;
    this.csrfToken = $('meta[name="csrf-token"]').attr('content');
}

/**
 * Set up page and event listeners
 */
Resource.prototype.init = function() {
    var self = this;

    // Set up event listener for resource add button
    $(document).on('click', '#resource-add-button', function () {
        self.clearForm();
        self.initializeAddModal();
    });

    // Set up event listener for resource add/edit form submissions
    $(document).on('submit', '#resource-form', function (event) {
        event.preventDefault();
        self.submitResourceForm();
    });

    // Set up event listener for resource delete form submissions
    $(document).on('submit', '#resource-delete-form', function(event){
        event.preventDefault();
        self.submitDeleteForm();
    });

    // Set up event listener for update button clicks
    $(document).on('click', '.resource-update-btn', function() {
        var resourceId = $(this).data('id');
        self.clearForm();
        self.initializeUpdateModal(resourceId);
    });

    // Set up event listener for delete button clicks
    $(document).on('click', '.resource-delete-btn', function(){
        var resourceId = $(this).data('id');
        self.clearForm();
        self.initializeDeleteModal(resourceId);
    });

    // Set up event listener for search button click
    $(document).on('click', '#search-button', function(event) {
        event.preventDefault();
        self.search($('[name=search_term]').val());
    });

    $('[name=search_term]').keypress(function (event) {
        if (event.keyCode == 13) {
            self.search($('[name=search_term]').val());
        }
    });
};

/**
 * Prepare resource edit modal for an add
*/
Resource.prototype.initializeAddModal = function() {
    var $modal = $('#resource-modal');

    // Set up modal title and button label
    $modal.find('.modal-heading').html('Add New ' +  this.resourceName);
    $modal.find('.submit-btn').html('Add ' + this.resourceName);

    // Set up appropriate HTTP Method for Laravel HTTP spoofing
    $modal.find('input[name=_method]').val('POST');

    // Set action url for form
    $modal.find('#resource-form').attr('action', this.baseUrl);

    $modal.modal('show');
};

/**
 * Prepare resource edit modal for an update
 */
Resource.prototype.initializeUpdateModal = function(resourceId) {
    var $modal = $('#resource-modal');
    var url = this.baseUrl;
    var self = this;

    $.ajax({
        type: 'get',
        url: url + '/' + resourceId,
        success: function (resource) {
            // Call the special update modal preparation function
            // for this resource
            self.prepareForUpdate(resource);

            // Set up modal title and button label
            $modal.find('.modal-heading').html('Update ' + self.resourceName);
            $modal.find('.submit-btn').html('Save');

            // Set up appropriate HTTP Method for Laravel HTTP spoofing
            $modal.find('input[name=_method]').val('PUT');

            // Set action url for form
            $modal.find('#resource-form').attr('action', self.baseUrl + '/' + resourceId);

            $modal.modal('show');
        }
    });
};

/**
 * Set up delete confirmation modal
 *
 * @param {int} resourceId The resource Id
 */
Resource.prototype.initializeDeleteModal = function(resourceId) {
    App.setDeleteForm(this.baseUrl + '/' + resourceId, 'Delete ' + this.resourceName);
    App.showConfirmDialog("Do you want to delete this " + this.resourceName.toLowerCase() + "?");
};

/**
 * Prepare modal for an update
 * Implementation to be done uniquely for each resource class
 *
 * @param {Object} resource Resource to be updated
 */
Resource.prototype.prepareForUpdate = function(resource) {
};

/**
 * Submit form for adding or updating resource
 */
Resource.prototype.submitResourceForm = function() {
    App.submitForm($('#resource-form').get(0), this.refreshPage.bind(this), $('#errors-container'));
};

/**
 * Submit form for adding or updating resource
 */
Resource.prototype.submitDeleteForm = function () {
    App.submitForm($('#resource-delete-form').get(0), this.refreshPage.bind(this), null);
};

/**
 * Clear the resource form
 */
Resource.prototype.clearForm = function() {
    $('#resource-form').get(0).reset();
    $('.modal-error-div').find('ul').html('');
    $('#errors-container').hide();
};

/**
 * Refresh page for a resource after
 */
Resource.prototype.refreshPage = function(keyword) {
    var $container = $('#resource-container');
    var url = this.baseUrl;

    keyword = keyword || null;

    if (keyword) {
        url += "?keyword=" + keyword;
    }

    $container.html("");

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $container.html(response);
        }
    });
};

/**
 * Conduct a search for this resource based on a given keyword
 *
 * @param {String} keyword
 */
Resource.prototype.search = function(keyword) {
    this.refreshPage(keyword);
}