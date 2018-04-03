/**
 * An object for managing tasks related to courses
 */
function Timetable(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Timetable);

/**
Timetable.prototype.initializeAddModal = function() {
    var $modal = $('#resource-modal');
    Resource.prototype.initializeAddModal.call(this);

    // Set up modal title and button label
    $modal.find('.modal-heading').html('Create New Timetable Set');
    $modal.find('.submit-btn').html('Generate');
};
*/

window.addEventListener('load', function () {
    var timetable = new Timetable('/timetables', 'Timetable');
    timetable.init();
    console.log(timetable.baseUrl);
});