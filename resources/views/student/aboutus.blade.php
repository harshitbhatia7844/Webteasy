@extends('layout.studentlayout')
@section('content')
<style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    section {
      max-width: 800px;
      margin: 2em auto;
      padding: 2em;
      background-color: white;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
      color: #3498db;
    }

    p {
      line-height: 1.6;
      color: #555;
    }
  </style>
    <section>
        <h2 class="text-center fw-bold mt-4">Our Mission</h2>
        <p class="mt-3">We are passionate about providing engaging and educational quizzes to our users. Our mission is to make learning fun and accessible to everyone through interactive and thought-provoking quizzes.</p>
        <h2 class="text-center fw-bold mt-4">What Makes Us Unique</h2>
        <ul class="list-group list-group-flush mt-3">
          <li class="list-group-item"><strong>User-Friendly Design:</strong> Our intuitive interface makes it easy for students to navigate, find quizzes, and track their progress.</li>
          <li class="list-group-item"><strong>Engaging Quizzes:</strong> We offer a variety of quizzes across different subjects and topics, all designed to spark curiosity and challenge thinking.</li>
          <li class="list-group-item"><strong>Instant Feedback:</strong> Students receive immediate results after completing a quiz, including their score, correct answers, and detailed explanations.</li>
          <li class="list-group-item"><strong>Flexible Learning:</strong> Quizzes can be taken at any time, from any device, providing a personalized learning experience that fits individual schedules.</li>
          <li class="list-group-item"><strong>Administrative Control:</strong> Our platform empowers educators to create, manage, and customize quizzes to align with their specific learning objectives.</li>
          <li class="list-group-item"><strong>Robust Security:</strong> We prioritize data protection and privacy, ensuring a secure environment for all users.</li>
        </ul>
        <h2 class="text-center fw-bold mt-4">Teacher's Guidance</h2>
        <p class="mt-3"><strong>Teacher Name:</strong> Professor Dr. Awakash Mishra (Dean-SoET)</p>
        <p>Our quizzes are designed under the expert guidance of Professor Dr. Awakash Mishra, ensuring that they align with educational standards and promote meaningful learning.</p>
        <h2 class="text-center fw-bold mt-4">Meet the Team</h2>
        <p class="mt-3"><strong>Harshit Bhatia</strong> - Project Manager & Backend Developer</p>
        <p><strong>Preeti Verma</strong> - Frontend & Database Developer</p>
        <p><strong>Swarnika Singh</strong> - Graphic Designer & Front End Developer</p>
    
        <h2 class="text-center fw-bold mt-4">Contact Us</h2>
        <p class="mt-3">Have questions or suggestions? Feel free to reach out to us at <a href="mailto:info@quizapp.com">info@quizapp.com</a>.</p>
      </section>
@endsection