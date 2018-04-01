/**
 * An object for managing tasks related to courses
 */
function CollegeClass(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, CollegeClass);

CollegeClass.prototype.prepareForUpdate = function (resource) {
    $('input[name=name]').val(resource.name);
};

window.addEventListener('load', function () {
    var collegeClass = new CollegeClass('/classes', 'class');
    collegeClass.init();
});