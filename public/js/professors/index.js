/**
 * An object for managing professors module
 */
function Professor(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Professor);

Professor.prototype.prepareForUpdate = function (resource) {
    $('input[name=name]').val(resource.name);
};

window.addEventListener('load', function () {
    var professor = new Professor('/professors', 'Professor');
    professor.init();
});