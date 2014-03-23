<style>
    td > input {
        width: 100% !important;
    }
</style>
<form>
    <div class="sixteen columns">
        <div class="three columns">
            <h3>From</h3>

            <input type="text" name="name" placeholder="Name">
            <input type="text" name="address" placeholder="Address">
            <input type="text" name="phone" placeholder="Phone">
            <input type="email" name="email" placeholder="Email">

            <h3>To</h3>

            <p>Department</p>
            <p>Institution</p>
            <p>Address</p>
        </div>
        <div style="text-align: right; float: right;" class="three columns">
            <h2>INVOICE</h2>

            <input type="text" name="date" placeholder="Date">
            <input type="text" name="client_number" placeholder="Client number">
            <input type="text" name="client_name" placeholder="Client name">
        </div>
    </div>
    <div class="sixteen columns">
        <table>
            <tr>
                <th scope="col" style="width: 35%;">Description</th>
                <th scope="col" style="width: 15%;">Start</th>
                <th scope="col" style="width: 15%;">End</th>
                <th scope="col" style="width: 10%;">Hours</th>
                <th scope="col" style="width: 15%;">Rate</th>
                <th scope="col" style="width: 10%;">Amount</th>
            </tr>
            <tr>
                <td><input type="text" name="" placeholder="Description"></td>
                <td><input type="text" name="" placeholder="Start"></td>
                <td><input type="text" name="" placeholder="End"></td>
                <td><input type="text" name="" placeholder="Hours" readonly></td>
                <td><input type="text" name="" placeholder="Rate"></td>
                <td><input type="text" name="" placeholder="Amount" readonly></td>
            </tr>
            <tr>
                <td><input type="text" name="" placeholder="Description"></td>
                <td><input type="text" name="" placeholder="Start"></td>
                <td><input type="text" name="" placeholder="End"></td>
                <td><input type="text" name="" placeholder="Hours" readonly></td>
                <td><input type="text" name="" placeholder="Rate"></td>
                <td><input type="text" name="" placeholder="Amount" readonly></td>
            </tr>            
            <tr>
                <td><input type="text" name="" placeholder="Description"></td>
                <td><input type="text" name="" placeholder="Start"></td>
                <td><input type="text" name="" placeholder="End"></td>
                <td><input type="text" name="" placeholder="Hours" readonly></td>
                <td><input type="text" name="" placeholder="Rate"></td>
                <td><input type="text" name="" placeholder="Amount" readonly></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right; padding-right: 1em;">$</td>
                <td><input type="text" name="" placeholder="0" readonly></td>
            </tr>
        </table>
    </div>
    <div class="three columns">
        <button type="button"><i class="fa fa-check"></i> Submit invoice</button>
    </div>
    <div class="three columns">
        <button type="button"><i class="fa fa-floppy-o"></i> Save draft</button>
    </div>
    <div class="three columns">
        <button type="button"><i class="fa fa-undo"></i> Clear form</button>
    </div>
</form>