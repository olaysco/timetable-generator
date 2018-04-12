/**
 * An object for managing tasks related to courses
 */
function CollegeClass(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, CollegeClass);

CollegeClass.prototype.init = function() {
    var self = this;

    Resource.prototype.init.call(self);

    $(document).on('click', '#course-add', function() {
        self.addCourse();
    });

    $(document).on('click', '.course-remove', function(event){
        var $el = $(event.target);
        var id = $el.data('id');

        $('#course-' + id + '-container').remove();
    });

    self.addCourse();
};

CollegeClass.prototype.addCourse = function(data) {
    var template = $('#course-template').html();
    var id = new Date().valueOf();
    data = data || null;

    template = template.replace(/{ID}/g, id);

    if (data) {
        $('#courses-container').prepend(template);
        $('[name=course-' + id + ']').val(data.course_id).change();
        $('[name=course-' + id + '-meetings]').val(data.meetings);
        $('[name=period-' + id + ']').val(data.academic_period_id).change();
    } else {
        $('#courses-container').append(template);
    }

    $('[name=course-' + id +']').select2();
    $('[name=period-' + id + ']').select2();
};

CollegeClass.prototype.prepareForUpdate = function (resource) {
    var self = this;

    $('input[name=name]').val(resource.name);
    $('input[name=size]').val(resource.size);
    $('#rooms-select').val(resource.room_ids).change();
    $('#courses-container .course-form').remove();

    $.each(resource.courses, function(index){
        var course = this;
        var data = {
            course_id: course.id,
            academic_period_id: course.pivot.academic_period_id,
            meetings: course.pivot.meetings
        };
        self.addCourse(data);
    });

    self.addCourse();
};

CollegeClass.prototype.clearForm = function() {
    // Clear the form using the usual way
    Resource.prototype.clearForm.call(this);

    // Clear the course select forms
    $('#courses-container .course-form').remove();

    // Add new initial course select form
    this.addCourse();
};

CollegeClass.prototype.submitResourceForm = function() {
    var $form = $('#resource-form');
    var url = $form.attr('action');
    var form;

    var data = {
        _token: this.csrfToken,
        _method: $('[name=_method]').val(),
        name: $form.find('[name=name]').val(),
        size: $form.find('[name=size]').val(),
        unavailable_rooms: $form.find('#rooms-select').val()
    };

    var courses = {};

    $('.course-form').each(function(index) {
        var $container = $(this);
        var courseId = $container.find('.course-select').val();
        var periodId = $container.find('.period-select').val();
        var meetings = $container.find('.course-meetings').val();

        if (courseId && meetings) {
            courses[courseId] = {
                'meetings' : meetings,
                'academic_period_id': periodId
            };
        }
    });

    data.courses = courses;
    var formData = new FormData();
    App.appendFormdata(formData, data);

    form = {
        url: url,
        data: formData
    };

    App.submitForm(form, this.refreshPage, $('#errors-container'), true, true);
};

window.addEventListener('load', function () {
    var collegeClass = new CollegeClass('/classes', 'class');
    collegeClass.init();
});