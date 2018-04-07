/**
 * An object for managing tasks related to courses
 */
function Course(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Course);

Course.prototype.prepareForUpdate = function (resource) {
    $('input[name=name]').val(resource.name);
    $('input[name=course_code]').val(resource.course_code);
    $('#professors-select').val(resource.professor_ids).change();
};

window.addEventListener('load', function () {
    var course= new Course('/courses', 'Course');
    course.init();
});