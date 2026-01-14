import React, { useMemo, useState } from 'react'
import { ComposableMap, Geographies, Geography, Marker } from 'react-simple-maps'

export type CountryDatum = {
  code: string
  name: string
  visits: number
}

type BubbleWorldMapProps = {
  data: CountryDatum[]
}

// Simplified ISO2 -> approximate coordinates (lng, lat)
const COUNTRY_COORDS: Record<string, [number, number]> = {
  US: [-98.35, 39.5],
  CA: [-106.35, 56.13],
  BR: [-51.9253, -14.235],
  AR: [-63.6167, -38.4161],
  GB: [-3.4359, 55.3781],
  FR: [2.2137, 46.2276],
  DE: [10.4515, 51.1657],
  EG: [30.8025, 26.8206],
  SA: [45.0792, 23.8859],
  AE: [53.8478, 23.4241],
  IN: [78.9629, 20.5937],
  CN: [104.1954, 35.8617],
  JP: [138.2529, 36.2048],
  AU: [133.7751, -25.2744],
}

function codeToFlagEmoji(code: string): string {
  if (!code || code.length !== 2) return ''
  const base = 127397
  const chars = code.toUpperCase().split('').map(c => String.fromCodePoint(base + c.charCodeAt(0)))
  return chars.join('')
}

function clamp(n: number, a: number, b: number) { return Math.max(a, Math.min(b, n)) }
function lerp(a: number, b: number, t: number) { return a + (b - a) * t }

const topoUrl = 'https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json'

export const BubbleWorldMap: React.FC<BubbleWorldMapProps> = ({ data }) => {
  const [hoveredCountry, setHoveredCountry] = useState<CountryDatum | null>(null)
  const [mousePosition, setMousePosition] = useState({ x: 0, y: 0 })

  const visits = data.map(d => d.visits)
  const max = Math.max(...visits, 1)
  const min = Math.min(...visits, 0)
  const sqrtMin = Math.sqrt(Math.max(min, 0))
  const sqrtMax = Math.sqrt(max)

  const baseScale = typeof window !== 'undefined' ? clamp(Math.min(window.innerWidth, 1280) / 1280, 0.8, 1) : 1

  const radiusFromVisits = (v: number) => {
    if (sqrtMax === sqrtMin) return Math.round(8 * baseScale)
    const t = (Math.sqrt(v) - sqrtMin) / (sqrtMax - sqrtMin)
    return Math.round(lerp(4, 12, t) * baseScale)
  }

  const opacityFromVisits = (v: number) => {
    if (sqrtMax === sqrtMin) return 0.6
    const t = (Math.sqrt(v) - sqrtMin) / (sqrtMax - sqrtMin)
    return lerp(0.35, 0.85, t)
  }

  const markers = useMemo(() => {
    return data
      .filter(d => COUNTRY_COORDS[d.code])
      .map(d => ({
        ...d,
        coord: COUNTRY_COORDS[d.code] as [number, number],
        r: radiusFromVisits(d.visits),
        alpha: opacityFromVisits(d.visits),
      }))
  }, [data])

  return (
    <div className="relative w-full rounded-2xl border border-white/10 overflow-hidden bg-gradient-to-br from-black/70 via-jet-black to-deep-charcoal">
      <div className="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-neon-purple/20 blur-3xl pointer-events-none" />
      <div className="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-neon-cyan/20 blur-3xl pointer-events-none" />

      <div className="px-2 py-3">
        <div className="text-sm text-gray-400">Global Audience Map</div>
        <div className="text-xl font-semibold">Where Your Visitors Come From</div>
      </div>

      <div className="w-full aspect-[2/1]">
        <ComposableMap projection="geoEqualEarth" width={980} height={490} style={{ width: '100%', height: '100%' }}>
          <Geographies geography={topoUrl}>
            {({ geographies }) =>
              geographies.map(geo => (
                <Geography
                  key={geo.rsmKey}
                  geography={geo}
                  style={{
                    default: { fill: '#0d0f14', stroke: 'rgba(255,255,255,0.08)', outline: 'none' },
                    hover: { fill: '#11131a', stroke: 'rgba(255,255,255,0.12)', outline: 'none' },
                    pressed: { fill: '#11131a', outline: 'none' },
                  }}
                />
              ))
            }
          </Geographies>

          {markers.map(m => (
            <Marker key={m.code} coordinates={m.coord}>
              <g
                transform={`translate(0,0)`}
                style={{ cursor: 'pointer' }}
                onMouseEnter={(e) => {
                  const countryData = data.find(d => d.code === m.code);
                  if (countryData) {
                    setHoveredCountry(countryData);
                    setMousePosition({ x: e.clientX, y: e.clientY });
                  }
                }}
                onMouseMove={(e) => {
                  setMousePosition({ x: e.clientX, y: e.clientY });
                }}
                onMouseLeave={() => {
                  setHoveredCountry(null);
                }}
              >
                <title>{`${codeToFlagEmoji(m.code)} ${m.name}: ${m.visits.toLocaleString()} visits`}</title>
                {/* single refined bubble */}
                <circle
                  r={m.r}
                  fill="url(#bubbleFill)"
                  fillOpacity={m.alpha}
                  stroke="rgba(255,255,255,0.25)"
                  strokeWidth={0.6}
                  filter="url(#bubbleShadow)"
                />
              </g>
            </Marker>
          ))}

          <defs>
            <radialGradient id="bubbleFill" cx="50%" cy="50%" r="60%">
              <stop offset="0%" stopColor="#8B5CF6" />
              <stop offset="100%" stopColor="#06B6D4" />
            </radialGradient>
            <filter id="bubbleShadow" x="-50%" y="-50%" width="200%" height="200%">
              <feDropShadow dx="0" dy="1" stdDeviation="1" floodColor="#8B5CF6" floodOpacity="0.25" />
            </filter>
          </defs>
        </ComposableMap>
      </div>

      <div className="px-4 py-3 flex items-center gap-4 text-xs text-gray-400">
        <div className="flex items-center gap-2"><span className="inline-block w-3 h-3 rounded-full bg-neon-purple" /> Higher traffic</div>
        <div className="flex items-center gap-2"><span className="inline-block w-3 h-3 rounded-full bg-neon-cyan" /> Medium</div>
      </div>

      {/* Tooltip */}
      {hoveredCountry && (
        <div
          className="fixed z-50 bg-black/90 border border-white/20 rounded-lg p-3 shadow-xl pointer-events-none"
          style={{
            left: mousePosition.x + 10,
            top: mousePosition.y - 10,
            transform: 'translateY(-100%)'
          }}
        >
          <div className="flex items-center gap-2 mb-2">
            <span className="text-lg">{codeToFlagEmoji(hoveredCountry.code)}</span>
            <span className="font-medium text-white">{hoveredCountry.name}</span>
          </div>
          <div className="text-sm text-gray-300">
            <div className="flex justify-between gap-4">
              <span>Visits:</span>
              <span className="font-medium text-neon-purple">{hoveredCountry.visits.toLocaleString()}</span>
            </div>
          </div>
        </div>
      )}
    </div>
  )
}