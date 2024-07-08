# Clima Tempo
This is my solution for <a href="https://github.com/climatempo/challenge-accepted/">climatempo</a> challenge

## Technologies
- frontend
    - Vue 3
    - TailwindCSS

- backend
    - PHP 8

## How to run this project
```bash
git clone https://github.com/k4ik/climatempo-challenge.git
cd climatempo-challenge

cd frontend
pnpm install
pnpm dev

cd backend
# create an account on https://weatherapi.com
# access https://www.weatherapi.com/my/ 
# copy API Key and paste it in the .env file
cp .env.example .env
php -S localhost:8000
```

or access this [link](https://climatempo-gray.vercel.app/) 