/**
 * An object for managing professors module
 */
function Professor(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Professor);

Professor.prototype.prepareForUpdate = function (resource) {
    console.log(resource);
    $('input[name=name]').val(resource.name);
    $('input[name=email]').val(resource.email);
    $('#courses-select').val(resource.course_ids).change();
    $('#periods-select').val(resource.periods).change();
};

window.addEventListener('load', function () {
    var professor = new Professor('/professors', 'Professor');
    professor.init();
});