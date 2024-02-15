@extends('layout.quizlayout')
@section('content')
    <style>
        .textup {
            text-align: center;
            color: rgb(223, 56, 18);
            font-weight: 700;
        }

        i {
            margin-right: 3px;
        }

        .form-box {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(36, 38, 67, 0.8);
            padding: 15px;
            border-radius: 8px;
            width: 600px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .radio-group {
            display: flex;
            margin-bottom: 16px;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 17px;
            color: rgb(4, 0, 128);
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border-radius: 10px;

        }
    </style>

    <div class="feedback mt-5" style="display: flex; justify-content: center;">
        <div class="form-box">
            <h3 style="text-align: center;">Feedback Form</h3>
            <div class="textup">
                <i class="fa fa-solid fa-clock"></i>
                It only takes two minutes!!
            </div>
            <form action="{{ route('student.savefeedback') }}" method="POST">
                @csrf
                <label>
                    <i class="fa-solid fa-face-smile"></i>
                    Do you satisfy with our Quiz portal?
                </label>
                <div class="radio-group">
                    <input type="radio" id="yes" name="satisfy" value="yes" checked>
                    <label for="yes">Yes</label>

                    <input type="text" name="test_id" value="{{$test_id}}" hidden>
                    <input type="radio" id="no" name="satisfy" value="no">
                    <label for="no">No</label>
                </div>

                <div class="form-group">
                    <label for="rating">Rate Us Out Of 5</label>
                    <select class="form-control" name="rating" id="rating">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option selected>5</option>
                    </select>
                </div>
                <div class="form-group" required>
                    <label for="level">Level Of Questions</label>
                    <select class="form-control" name="level" id="level">
                        <option>Easy</option>
                        <option>Medium</option>
                        <option>Hard</option>
                    </select>
                </div>

                <label for="msg">
                    <i class="fa-solid fa-comments" style="margin-right: 3px;"></i>
                    Write your Suggestions:
                </label>
                <textarea id="msg" name="suggestions" rows="4" cols="10"></textarea>
                <div class="d-flex">
                    <a href="{{route('student.dashboard')}}" class="btn btn-outline-secondary w-50 mt-3 me-3">Skip</a>
                    <button class="btn btn-primary mt-3 w-50 me-auto" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
