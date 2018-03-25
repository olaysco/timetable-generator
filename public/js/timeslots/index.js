/**
 * An object for managing tasks related to timeslots
 */
function Timeslot(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Timeslot);

Timeslot.prototype.prepareForUpdate = function (resource) {
    console.log(resource);
    $('select[name=from]').val(resource.from).change();
    $('select[name=to]').val(resource.to).change();
};

window.addEventListener('load', function () {
    var timeslot = new Timeslot('/timeslots', 'Timeslot');
    timeslot.init();
});