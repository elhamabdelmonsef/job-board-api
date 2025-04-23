## 📘 Job Board API

A RESTful API built with Laravel for managing and filtering job postings with advanced filtering capabilities including EAV (Entity-Attribute-Value) attributes.

---



🚀 Setup Instructions

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/job-board-api.git
   cd job-board-api
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Setup your `.env` file and generate application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:

   ```bash
   php artisan serve
   ```

---

### 📡 API Endpoints

#### Get All Jobs with Filtering

```http
GET /api/jobs?filter=(job_type=full-time AND attribute:years_experience>=3 AND attribute:education_level="Bachelor")
```

##### Query Parameters:

- `filter`: A logical expression that supports `AND`, `OR`, parentheses `()`, and filtering by attributes or relationships.

---

### 🧠 Filtering Syntax

- **Basic Filters:**

    - `job_type=full-time`
    - `title="Software Engineer"`

- **Relationship Filters:**

    - `languages HAS_ANY (English,Arabic)`
    - `locations IS_ANY (Cairo,Dubai)`

- **EAV Attribute Filters:**

    - `attribute:years_experience>=3`
    - `attribute:education_level="Bachelor"`

- **Combining Filters with Logic:**

    - `(job_type=full-time AND attribute:years_experience>=3)`
    - `(languages HAS_ANY (English) OR locations IS_ANY (Dubai))`

---

### 🔍 Examples of Complex Queries

1. Jobs requiring at least 3 years experience and full-time:

   ```
   /api/jobs?filter=(job_type=full-time AND attribute:years_experience>=3)
   ```

2. Jobs located in Cairo or Dubai, and requiring a Bachelor's degree:

   ```
   /api/jobs?filter=(locations IS_ANY (Cairo,Dubai) AND attribute:education_level="Bachelor")
   ```

3. Jobs with either English language or at least 5 years experience:

   ```
   /api/jobs?filter=(languages HAS_ANY (English) OR attribute:years_experience>=5)
   ```

---

### 📦 Postman Collection

https://api.postman.com/collections/10491908-fcd60063-d1cf-456f-a202-1ac967fa7158?

---

### 💡 Design Decisions and Assumptions

- EAV attributes are filtered using the format `attribute:<slug><operator><value>`
- Only selected operators are supported: `=`, `>=`, `<=`, `IN`
- Relationships like `languages` and `locations` use keywords `HAS_ANY`, `IS_ANY`
- Filters are parsed manually but can be extended to use a parser like PEG later

