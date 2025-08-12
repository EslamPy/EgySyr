export type Job = {
  slug: string
  title: string
  department: string
  location: string
  type: string
  experience: string
  description: string
  skills: string[]
  salary: string
}

export type JobInput = Omit<Job, 'slug'>

export type Application = {
  id: string
  jobSlug: string
  jobTitle: string
  name: string
  email: string
  coverLetter?: string
  resumeDataUrl?: string
  createdAt: string
}

const JOBS_KEY = 'jobs.custom'
const APPS_KEY = 'jobs.applications'

export function slugify(input: string): string {
  return input
    .toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .trim()
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
}

export function listCustomJobs(): Job[] {
  try {
    const raw = localStorage.getItem(JOBS_KEY)
    if (!raw) return []
    return JSON.parse(raw) as Job[]
  } catch {
    return []
  }
}

export function saveCustomJobs(jobs: Job[]): void {
  try { localStorage.setItem(JOBS_KEY, JSON.stringify(jobs)) } catch {}
}

export function addJob(input: JobInput): Job {
  const slug = slugify(input.title)
  const job: Job = { slug, ...input }
  const current = listCustomJobs()
  const existingIdx = current.findIndex(j => j.slug === slug)
  if (existingIdx >= 0) current[existingIdx] = job
  else current.push(job)
  saveCustomJobs(current)
  return job
}

export function updateJob(slug: string, input: JobInput): Job {
  const newSlug = slugify(input.title)
  const updated: Job = { slug: newSlug, ...input }
  const current = listCustomJobs().filter(j => j.slug !== slug)
  current.push(updated)
  saveCustomJobs(current)
  return updated
}

export function deleteJob(slug: string): void {
  const current = listCustomJobs().filter(j => j.slug !== slug)
  saveCustomJobs(current)
}

export function getAllJobs(defaultJobs: Omit<Job, 'slug'>[]): Job[] {
  const defaults: Job[] = defaultJobs.map(j => ({ ...j, slug: slugify(j.title) }))
  const custom = listCustomJobs()
  const bySlug = new Map<string, Job>()
  for (const j of defaults) bySlug.set(j.slug, j)
  for (const j of custom) bySlug.set(j.slug, j)
  return Array.from(bySlug.values())
}

export function listApplications(): Application[] {
  try {
    const raw = localStorage.getItem(APPS_KEY)
    if (!raw) return []
    return JSON.parse(raw) as Application[]
  } catch {
    return []
  }
}

export function saveApplications(apps: Application[]): void {
  try { localStorage.setItem(APPS_KEY, JSON.stringify(apps)) } catch {}
}

export function addApplication(app: Omit<Application, 'id' | 'createdAt'>): Application {
  const newApp: Application = {
    id: Math.random().toString(36).slice(2),
    createdAt: new Date().toISOString(),
    ...app,
  }
  const current = listApplications()
  current.unshift(newApp)
  saveApplications(current)
  return newApp
}

export function listAdminJobs(): Job[] {
  return listCustomJobs().sort((a, b) => a.title.localeCompare(b.title))
} 