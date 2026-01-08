# Design System — Toko Aksesoris Mobil

## Visual Concept
- Theme: Automotive luxury & performance
- Mood: Clean, elegant, futuristic, premium
- Imagery: sports cars, metal finishes, subtle neon accents

## Colors (tokens)
- Primary Background: --bg-dark: #0b0f13 (dark matte)
- Charcoal / Surface: --charcoal: #0f1720
- Metal Accent: --metal: #6b7280
- Accent Red (racing): --accent-red: #e31b23
- Accent Blue (neon): --accent-blue: #00b4ff
- Glass overlay: rgba(255,255,255,0.04)

## Typography
- Primary font: Poppins (weights: 300,400,600,700,800)
- Secondary: Inter for body fallback
- Headings: bold, tight leading
- Body: clean, readable, medium contrast

## Spacing & Radius
- Base radius: 12px
- Card elevation: soft shadow and subtle lift on hover
- Spacing scale: 8 / 12 / 16 / 24 / 32 / 48

## Buttons
- Primary: filled, accent-red gradient, strong shadow, rounded
- Secondary: transparent with subtle border, hover glow
- Small: padding reduced, used inside cards

## Components
- Navbar: semi-transparent glass, backdrop blur, minimal links
- Hero: full-width background with sport car silhouette, large CTA
- Product Card: image, badge (sale / best), title, price, small actions
- Badges: SALE (red), BEST (blue), OUT (grey)
- Admin Dashboard: dark cards, data summary

## Motion & Interaction
- Soft hover lift for cards and buttons
- Subtle microinteractions (button press, badge highlight)
- Respect `prefers-reduced-motion`

## Assets
- hero-car.svg (stylized silhouette)
- product svgs (oli.svg, busi.svg, filter.svg, aki.svg, karpet.svg)

## How to use
- CSS tokens defined in `assets/css/theme.css`
- Use `.theme-premium` on body to enable the system
- Use `btn primary` and `btn secondary` for CTAs

---
Design ready for HTML/CSS prototype and to be exported into Figma components as needed.