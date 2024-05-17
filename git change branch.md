### GIT Change branch

# Ensure You're on the Correct Branch

First, check which branch you're currently on:

bash
Copy code
git branch
This command lists all local branches and highlights the current one with an asterisk (*). If you're not on the main branch, you need to create it.

# Create and Switch to the main Branch

If main doesn't exist, create it and switch to it:

bash
Copy code
git checkout -b main


# Stage and Commit Your Changes

Make sure all your changes are staged and committed:

bash
Copy code
git add .
git commit -m "Initial commit"


# Push to the Remote Repository

Now, push your changes to the remote repository:

bash
Copy code
git push -u origin main