# Design Guide — Premium Dark Theme (Automotive)

## Objective
Buat tampilan yang lebih clean, elegan, dan premium — tetap mempertahankan identitas otomotif.

---

## Tokens
- Primary gradient: dark navy → black
  - `--bg-800: #071428`
  - `--bg-900: #02040a`
  - `--bg-gradient: linear-gradient(180deg,var(--bg-800),var(--bg-900))`
- Accent (elegant red): `--accent: #A71B23`
- Accent weak glow: `--accent-weak: rgba(167,27,35,0.12)`
- Surface translucency: `--surface-100/200`
- Text primary: `--text: #e6eef6`
- Muted: `--muted: #9aa6b2`

## Typography
- Headings: `Poppins` (700) — bold, modern
- Body: `Inter` — readable for long reads
- Sizes: H1 big and bold (2.4–3.2rem responsive), body 16px base

## Spacing & Radius
- Radius: 8 / 16 / 24px (small / medium / large)
- Elevation: soft shadow for cards, stronger shadow on hover
- Spacing scale: 8 / 12 / 16 / 24 / 32 / 48

## Buttons
- Primary: filled gradient using `--accent`, strong but elegant shadow, rounded (12px)
- Secondary: transparent with subtle border and soft glow on hover
- Interaction: smooth transform and box-shadow on hover (0.3s)

## Components
- Navbar: glassmorphism (blurred backdrop), sticky, prominent logo (`Poppins`), rounded search bar with icon inside, cart with badge
- Hero: dramatic heading + supporting text, glass CTA, optional blurred automotive visual or gradient
- Product Card: large radius (16–24px), soft shadow, hover uplift + glow, price prominent, badges for Promo/Best/Habis
- Badges: Promo (muted-elegant red gradient), Best (golden gradient), Habis (muted grey)

## Motion & Interaction
- Global transition: `300ms cubic-bezier(.2,.9,.3,1)`
- Hover: translateY(-6 to -8px) + stronger shadow
- Micro interactions: button hover, focus states, light scroll reveal

## Accessibility
- Ensure color contrast for price and important CTAs
- Provide focus outlines and `prefers-reduced-motion` fallbacks

## Implementation Notes
- Add `assets/css/premium-theme.css` containing tokens and components (prototype added in `design/ui-prototype.html`)
- Load premium theme after base styles in `inc/header.php` when enabling redesign
- Use `repeat(auto-fit, minmax(220px, 1fr))` for product grid

---

## Preview & Prototype
- Open `design/ui-prototype.html` to preview components (navbar, hero, product cards)
- Prototype includes a mobile preview frame for testing mobile-first layouts
- Prototype static, intended to be integrated into templates for final tuning

---

## Mobile guidance
- Mobile-first: ensure components stack, reduce hover-only overlays, and expand tap targets to at least 44px.
- For product cards, actions overlay becomes a stacked block on small screens.
- Use `.demo-mobile` in `design/ui-prototype.html` to see a guided mobile view.

---

## Wrap-up & Handoff
- Status: Completed prototype, theme integration, hero, navbar, product cards, micro-interactions, accessibility, and mobile polish.

### Handoff notes
- Theme file: `assets/css/premium-theme.css` — enable by including it in `inc/header.php` (already done).
- Prototype: `design/ui-prototype.html` (includes mobile preview frame)
- Accessibility: keyboard focus, reduced-motion respected, `sr-only` helper available
- Mobile: tap targets enlarged; product card actions stacked on small screens

### Recommended QA
1. Run `php tools/smoke_test.php http://localhost/aksesoris_mobil2` and fix any HTTP errors
2. Manual keyboard navigation test (tab order, focus states)
3. Lighthouse accessibility & performance audit (aim for accessibility > 90)
4. Capture screenshots and add to `assets/img/screenshots/`

5. (Optional) Create Figma components from `design/ui-prototype.html` for visual handoff

