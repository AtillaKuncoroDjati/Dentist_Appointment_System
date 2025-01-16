<section id="appointment" class="appointment section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Make an <span style="color: #1b75bc; font-style: italic;">Appointment</span></h2>
            <p>Silakan isi data diri anda dan pelayanan yang diinginkan.</p>
        </div>

        <form id="appointmentForm" action="{{ route('appointment.store') }}" method="POST" role="form"
            class="php-email-form" data-aos="fade-up" data-aos-delay="100">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                        required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                        required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone"
                        required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <select name="doctor" id="doctor" class="form-select">
                        <option value="">Select Doctor</option>
                        <option value="Dr. Walter White">Dr. Walter White</option>
                        <option value="Dr. Sarah Jhonson">Dr. Sarah Jhonson</option>
                        <option value="Dr. William Anderson">Dr. William Anderson</option>
                        <option value="Dr. Amanda Jepson">Dr. Amanda Jepson</option>
                    </select>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="services" id="services" class="form-select">
                        <option value="">Select services</option>
                        <option value="scaling"> Scaling</option>
                        <option value="bleaching"> Bleaching</option>
                        <option value="veener"> Veener</option>
                    </select>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <input type="text" name="date" class="form-control" id="date"
                        placeholder="Appointment Date" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="proof">
                    Upload Proof of Transfer
                    <span class="info-icon" data-tooltip="To make an appointment, you need to transfer to account number 23423482342 with an amount of Rp. 50,000.">ℹ️</span>
                </label>
                <input type="file" class="form-control" name="proof" id="proof" accept="image/*">
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
            </div>
            <div class="my-3">
                <div class="sent-message" id="successMessage" style="display:none;">Appointment berhasil dibuat!</div>
                <div class="error-message" id="errorMessage" style="display:none;">Error: Gagal mengirim appointment.
                    Mohon coba lagi.</div>
            </div>
            <div class="text-center"><button type="submit">Make an Appointment</button></div>
        </form>
    </div>
</section>

<!-- Modal for Available Times -->
<div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="availabilityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="availabilityModalLabel">Available Times</h5>
            </div>
            <div class="modal-body">
                <p>The selected time slot is already booked. Please choose another time from the available times below:
                </p>
                <ul id="availableTimesList"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/js/user/appointment.js') }}"></script>
