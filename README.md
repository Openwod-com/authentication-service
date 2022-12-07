# Authentication Service
En mikrotjänst för att hantera autentisering av användare.

## Gymnasiearbetet
Projektet är kopplat till gymnasiearbetet Rasmus Wiktell Sundman gör.

## Autentisering
Olika enpoints kärver olika autentisering.
Det finns tre olika autentiseringskrav. Endpoints kan antingen vara öppna för alla, endast via användarens JWT eller servicekonto. När användarens JWT och servicekonto används måste den även ha rätt behörigheter.

Användarens JWT skickas som en session kaka, medans service användarens  
För att autentisera med service konto ska dess token skickas som en Authentication header enligt formatet "Bearer TOKEN"

För att skapa service konton, se [Opwnwod service-accounts](https://github.com/Openwod-com/service-accounts)

# Routes
```
GET /public_key
    Returnerar den publika nyckel som tillhör den privata nyckeln som används för att signera JWTs.

POST /login
    Loggar in till ett redan existerande konto.

POST /accounts
    Body:
        user_id: number
            UserID from user-service.
        email: string, email format
        password: string
        admin: boolean
    Endpointen används för att skapa kontot i autentiserings tjänsten. Det är User-service som hanterar användarens begäran.
    Service konto rättighet: account.create
```

## TODO:
Check for sql exception in create account
