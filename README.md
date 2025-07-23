# AI-Chatbot-interface-using-html-css-and-php

I have created this project using html, css and php

AI Assistant Web Application
Overview
This project is a web-based AI Assistant application that provides an interactive chat interface, inspired by modern UI designs. It allows users to interact with an AI powered by Google's Gemini API, with features like chat history storage, a responsive design, and a sleek, glassmorphism-inspired aesthetic. The application includes a welcome page, a main chat interface, and backend scripts for handling AI responses and chat history.
Features

Chat Interface: Users can send queries to the AI and receive responses, displayed in a clean, scrollable chat box.
Chat History: Stores user queries and AI responses in a MySQL database, retrievable via a PHP backend.
Responsive Design: Optimized for desktop and mobile devices, with a sidebar navigation and adaptive layout.
Glassmorphism UI: Uses blurred backgrounds, translucent elements, and modern animations for a visually appealing experience.
Clear Chat Option: Allows users to clear the chat history from the interface.
Sign-In/Sign-Up Placeholder: Includes buttons for future authentication functionality.
Welcome Page: A simple entry point to the application.

File Structure

welcome.html: Entry page with a "Let's Go!" button to navigate to the main interface.
index.html: Main HTML file containing the chat interface, sidebar navigation, and background video.
fetch_history.php: PHP script to retrieve chat history from the MySQL database.
backend.php: PHP script handling user queries, interacting with the Gemini API, and storing chat history.
style.css: CSS file for styling the interface, including glassmorphism effects, responsive design, and animations.
images/: Directory for static assets like background videos or logos (not included in the provided code but referenced).

Installation
Prerequisites

A web server with PHP support (e.g., XAMPP, WAMP, or a hosted server).
MySQL database for storing chat history.
A valid Google Gemini API key (replace the placeholder in backend.php).
A modern web browser (Chrome, Firefox, etc.) for optimal rendering.

Setup

Clone the Repository:
git clone https://github.com/your-username/ai-assistant.git
cd ai-assistant


Set Up the Database:

Create a MySQL database named ai_assistant.
Create a table for chat history:CREATE TABLE chat_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_query TEXT NOT NULL,
    ai_response TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);


Update the database credentials in fetch_history.php and backend.php if different from localhost, root, root.


Configure the Gemini API:

Replace the apiKey in backend.php with your own Google Gemini API key:$apiKey = 'YOUR_GEMINI_API_KEY';


Obtain an API key from Google AI Studio.


Host the Application:

Place all files in your web server's root directory (e.g., htdocs for XAMPP).
Ensure the images folder (if used) is in the same directory as index.html.


Run the Application:

Start your web server and MySQL service.
Open welcome.html in a browser (e.g., http://localhost/ai-assistant/welcome.html).



Usage

Welcome Page: Click "Let's Go!" to navigate to the main chat interface.
Chat Interface: Enter a query in the input field and click the send button (or press Enter). The AI response will appear in the chat box.
Clear Chat: Click the "Clear Chat" button to reset the chat display (note: this does not clear the database history).
Sidebar Navigation: Use the "Sign In" and "Sign Up" buttons (placeholders for future functionality).
Chat History: The application automatically stores queries and responses in the database, which can be viewed in the chat box on page load.

Styling

Glassmorphism Design: Uses blurred backgrounds, translucent elements, and subtle borders for a modern look.
Responsive Layout: Adapts to screen sizes, with a narrower sidebar and full-width chat box on mobile devices (below 768px).
Custom Scrollbar: Styled scrollbar for the chat box to match the aesthetic.
Animations: Smooth transitions for button hovers and chat message rendering.

JavaScript and PHP Functionality

JavaScript (implied, not provided):
Likely handles dynamic chat updates, fetching history via fetch_history.php, and sending queries to backend.php.
Manages UI interactions like sending messages and clearing the chat box.


PHP Backend:
backend.php: Processes user queries, sends them to the Gemini API, and stores responses in the database. Includes fallback responses for common queries if the API fails.
fetch_history.php: Retrieves and formats chat history as JSON for display in the chat box.



Limitations

API Dependency: Requires a valid API key

License

© Copyright 2025 Ahmad Samama. All Rights Reserved.

I am sharing Some pictures of the project below:

1. Welcome Interface

<img width="1440" height="812" alt="Welcome" src="https://github.com/user-attachments/assets/ee8de02c-d214-45b9-967c-4ac04d6e4f55" />

2. User Interface

<img width="1440" height="814" alt="UserInterface" src="https://github.com/user-attachments/assets/e02abdbd-1a09-4d4b-b3ea-3c428d2f53b9" />

3. Chat Interface

<img width="1440" height="812" alt="Chat" src="https://github.com/user-attachments/assets/2e231bd6-1ef5-4810-9bce-49e131e060f1" />

